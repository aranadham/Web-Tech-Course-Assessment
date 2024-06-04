<?php
include "conn.php";

$response = [
    'courseData' => [],
    'cloData' => [],
    'cloDetailData' => [],
    'gradeDetailData' => [],
    'error' => '',
];

if (isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];

    // Fetch data from the subject table
    $courseSql = "SELECT * FROM subject WHERE Subject_ID = '$subject_id'";
    $courseResult = $conn->query($courseSql);

    if ($courseResult) {
        while ($row = $courseResult->fetch_assoc()) {
            $response['courseData'][] = $row;
        }
    } else {
        $response['error'] .= "Error fetching course data: " . $conn->error . ". ";
    }

    // Fetch data from the clo table
    $cloSql = "SELECT * FROM clo WHERE Subject_ID = '$subject_id'";
    $cloResult = $conn->query($cloSql);

    if ($cloResult) {
        while ($row = $cloResult->fetch_assoc()) {
            $response['cloData'][] = $row;
        }
    } else {
        $response['error'] .= "Error fetching CLO data: " . $conn->error . ". ";
    }

    // Fetch CLO_IDs for the subject
    $cloIds = [];
    foreach ($response['cloData'] as $clo) {
        $cloIds[] = $clo['CLO_ID'];
    }
    $cloIdString = implode(",", $cloIds);

    // Fetch data from the clo_detail table using the retrieved CLO_IDs
    $cloDetailSql = "SELECT * FROM clo_detail WHERE CLO_ID IN ($cloIdString)";
    $cloDetailResult = $conn->query($cloDetailSql);

    if ($cloDetailResult) {
        while ($row = $cloDetailResult->fetch_assoc()) {
            $response['cloDetailData'][] = $row;
        }
    } else {
        $response['error'] .= "Error fetching CLO detail data: " . $conn->error . ". ";
    }

    // Fetch data from the grade_detail table
    $gradeDetailSql = "SELECT * FROM grade_detail WHERE Subject_ID = '$subject_id'";
    $gradeDetailResult = $conn->query($gradeDetailSql);

    if ($gradeDetailResult) {
        while ($row = $gradeDetailResult->fetch_assoc()) {
            $response['gradeDetailData'][] = $row;
        }
    } else {
        $response['error'] .= "Error fetching grade detail data: " . $conn->error . ". ";
    }

    $conn->close();
} else {
    $response['error'] = "Subject ID not provided!";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
