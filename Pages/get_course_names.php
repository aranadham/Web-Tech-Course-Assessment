<?php
include 'conn.php';

// Query to retrieve course names and Subject_IDs from your database
$sql = "SELECT Subject_ID, Course_Name FROM subject";

$result = $conn->query($sql);

$courseData = [];
while ($row = $result->fetch_assoc()) {
    $courseData[] = $row;
}

$conn->close();

// Return course data as JSON
header('Content-Type: application/json');
echo json_encode($courseData);
?>
