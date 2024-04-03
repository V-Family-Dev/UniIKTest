<?php

include '../../DB/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $areaStatus = 1;
    $stmt = $conn->prepare("SELECT `area_id`, `area_name` FROM `privileges` WHERE `area_status` = ?");
    $stmt->bind_param("i", $areaStatus);
    $stmt->execute();
    $data = array();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
}
