<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../DB/dbconfig.php';
    $id = intval($_POST['id']);
    $status = intval($_POST['status']);

    $data = array();
    $stmt = $conn->prepare("UPDATE `privileges` SET `area_status`=? WHERE `area_id`= ?");
    $stmt->bind_param("ii", $status, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $data['status'] = 'success';

    echo json_encode($data);
}
