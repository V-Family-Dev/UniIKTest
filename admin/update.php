<?php
require_once '../DB/dbconfig.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'changePassword') {
    // Extract other POST data
    $uderid = isset($_POST['id']) ? $_POST['id'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password = hashs($password);

    if ($uderid == '' || $password == '') {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid data'));
        exit;
    }
    $update = $conn->prepare("UPDATE `admin` SET `password`=? WHERE `admin_id`=?");
    $update->bind_param("si", $password, $uderid);
    $update->execute();

    if ($update) {
        echo json_encode(array('status' => 'success', 'message' => 'Password changed successfully'));
        exit;
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to change password'));
        exit;
    }
    $update->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'deleteUser') {
    $uderid = isset($_POST['id']) ? $_POST['id'] : '';
    if ($uderid == '') {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid data'));
        exit;
    }


    $delete = $conn->prepare("UPDATE `admin` SET `admin_status`='0' WHERE `admin_id`=?");
    $delete->bind_param("i", $uderid);
    $delete->execute();
    if ($delete) {
        echo json_encode(array('status' => 'success', 'message' => 'User deleted successfully'));
        exit;
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to delete user'));
        exit;
    }
    $delete->close();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'activeuser') {
    $uderid = isset($_POST['id']) ? $_POST['id'] : '';
    if ($uderid == '') {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid data'));
        exit;
    }
    $active = $conn->prepare("UPDATE `admin` SET `admin_status` = 1 WHERE `admin_id` = ?");
    $active->bind_param("i", $uderid);
    $result = $active->execute();
    $active->close();

    if ($result) {
        echo json_encode(array('status' => 'success', 'message' => 'User activated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to activate user'));
    }
}












function hashs($password)
{
    $salt = 'amarabandurupasinghe';
    $hash = md5($salt . $password);

    for ($i = 0; $i < 1000; $i++) {
        $hash = md5($hash);
    }

    return $hash;
}
