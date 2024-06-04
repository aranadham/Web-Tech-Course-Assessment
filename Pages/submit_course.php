<?php
include 'conn.php';

$data = json_decode(file_get_contents('php://input'), true);

$courseName = $data['courseName'];
$courseCode = $data['courseCode'];
$session = $data['session'];
$lec = $data['lec'];
$date = $data['date'];

$sql = "INSERT INTO subject (Course_Name, Course_Code, Session, Lec, Date) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $courseName, $courseCode, $session, $lec, $date);

if ($stmt->execute()) {
    echo json_encode(["message" => "Course information inserted successfully"]);
} else {
    echo json_encode(["message" => "Error inserting course information"]);
}

$stmt->close();
$conn->close();
?>
