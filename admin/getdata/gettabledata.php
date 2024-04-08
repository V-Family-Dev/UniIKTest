<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../DB/dbconfig.php';
    $action = $_POST['action'];
    if ($action == 'active') {
        $stmt = $conn->prepare("
    SELECT a.admin_id, a.user_name, 
           GROUP_CONCAT(p.area_name ORDER BY p.area_name SEPARATOR ', ') AS accessible_areas
    FROM admin a
    LEFT JOIN admin_privileges ap ON a.admin_id = ap.admin_id AND ap.ap_status = 1
    LEFT JOIN privileges p ON ap.privileges_id = p.area_id
    WHERE a.admin_status = 1
    GROUP BY a.admin_id
");
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
