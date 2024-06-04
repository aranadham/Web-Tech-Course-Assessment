<?php
include 'conn.php';

$data = json_decode(file_get_contents('php://input'), true);

$studentId = $data['studentId'];
$name = $data['studentName'];
$matrixNumber = $data['matrixNumber'];
$email = $data['email'];
$subjectid = $data['subjectId'];

$sql = "INSERT INTO student (Student_ID,Name, Matrix_Number, Email, Subject_ID ) VALUES (?, ?, ?, ?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $studentId,$name, $matrixNumber, $Email,$subjectid);

if ($stmt->execute()) {
    echo json_encode(["message" => "Student information inserted successfully"]);
} else {
    echo json_encode(["message" => "Error inserting student information"]);
}

$stmt->close();
$conn->close();
?>
