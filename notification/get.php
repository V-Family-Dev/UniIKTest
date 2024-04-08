<?php
require_once '../DB/dbconfig.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'getNotification') {
        $empid = $_POST['empid'];
        echo json_encode(getNotifications($conn, $empid));
    }
}

function getNotifications($conn, $empid)
{
    $stmt = $conn->prepare("SELECT pn.*, m.title, m.messenge  FROM `push_notifications` AS pn JOIN `messenge` AS m ON pn.msg_id = m.mid WHERE pn.`emp_id` = ?");
    $stmt->bind_param("s", $empid);
    $stmt->execute();
    $result = $stmt->get_result();

    $notifications = array();
    if ($result->num_rows > 0) {
        $notifications['howmany'] = $result->num_rows;
        while ($row = $result->fetch_assoc()) {
            $notifications['messenge'] = $row['messenge'];
            $notifications['title'] = $row['title'];
             $notifications['quty'] = $row['quty'];
            $notifications['notifications'][] = $row;
        }
    } else {
        $notifications['howmany'] = 0;
        $notifications['notifications'] = [];
    }
    return $notifications;
}
