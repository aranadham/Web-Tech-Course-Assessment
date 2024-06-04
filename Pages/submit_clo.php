<?php
include 'conn.php';

$data = json_decode(file_get_contents('php://input'), true);

$subjectId = $data['subjectId'];
$cloId = $data['cloId'];
$cloCaption = $data['cloCaption'];
$cloDescription = $data['cloDescription'];
$percentage = $data['percentage'];

$sql = "INSERT INTO clo (Subject_ID, CLO_ID, CLO_Caption, CLO_Description, Persentage) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $subjectId, $cloId, $cloCaption, $cloDescription, $percentage);

if ($stmt->execute()) {
    echo json_encode(["message" => "CLO information inserted successfully"]);
} else {
    echo json_encode(["message" => "Error inserting CLO information"]);
}

$stmt->close();
$conn->close();
?>
