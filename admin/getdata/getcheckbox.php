<?php
include '../../DB/dbconfig.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'getactiveCheckbox':
            $stmt = $conn->prepare("SELECT `area_id`, `area_name`, `area_status` FROM `privileges` WHERE `area_status` = 1");
            break;
        case 'getCheckbox':
            $stmt = $conn->prepare("SELECT `area_id`, `area_name`, `area_status` FROM `privileges`");
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
            exit;
    }

    $stmt->execute();
    $data = array();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}
