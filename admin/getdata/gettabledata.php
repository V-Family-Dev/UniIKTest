<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../DB/dbconfig.php';
    $action = $_POST['action'];
    if ($action == 'active') {
        $stmt = $conn->prepare("SELECT * FROM admin where admin_status=1");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else if ($action == 'inactive') {
        $stmt = $conn->prepare("SELECT * FROM `admin` WHERE `admin_status`=0");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }
}
