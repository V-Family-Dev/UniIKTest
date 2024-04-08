<?php
require_once '../../DB/dbconfig.php';

//header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');
    $username = $_POST['username'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM `admin` WHERE `user_name`= ?");
    if (!$stmt) {
        echo json_encode(array("message" => "Failed to prepare statement"));
        exit;
    }

    $stmt->bind_param("s", $username);
    if (!$stmt->execute()) {
        echo json_encode(array("message" => "Failed to check username"));
        exit;
    }

    $result = $stmt->get_result();
    $rowCount = $result->num_rows;

    $data = $rowCount > 0;
    echo json_encode($data);

    $stmt->close();
    $conn->close();
}
