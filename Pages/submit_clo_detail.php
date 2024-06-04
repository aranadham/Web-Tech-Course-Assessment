<?php
include 'conn.php';

$data = json_decode(file_get_contents('php://input'), true);

$cloDetailId = $data['cloDetailId'];
$cloId = $data['cloId'];
$gradeId = $data['gradeId'];
$percentage = $data['percentage'];

$sql = "INSERT INTO clo_detail (CLO_Detail_ID, CLO_ID, Grade_ID, Percentage) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $cloDetailId, $cloId, $gradeId, $percentage);

$response = ["message" => ""];

if ($stmt->execute()) {
    $response["message"] = "CLO detail information inserted successfully";
} else {
    $response["message"] = "Error inserting CLO detail information";
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
