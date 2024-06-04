<?php
include 'conn.php';

$data = json_decode(file_get_contents('php://input'), true);

$gradeId = $data['gradeId'];
$activityName = $data['activityName'];
$percentage = $data['percentage'];
$studentId = $data['studentId'];
$subjectId = $data['subjectId'];

$sql = "INSERT INTO grade_detail (grade_id, activity_name, percentage, student_id, subject_id) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $gradeId, $activityName, $percentage, $studentId, $subjectId);

if ($stmt->execute()) {
    echo json_encode(["message" => "Grade detail information inserted successfully"]);
} else {
    echo json_encode(["message" => "Error inserting grade detail information"]);
}

$stmt->close();
$conn->close();
?>
