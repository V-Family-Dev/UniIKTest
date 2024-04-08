<?php
//require "../../functions/user/pushfunction.php";
require "../../DB/dbconfig.php";


function insertMessage($conn, $title, $message, $adminId)
{
    $stmt = $conn->prepare("INSERT INTO `messenge` (`title`, `messenge`, `admin_id`) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $message, $adminId);
    $stmt->execute();
    return $conn->insert_id;
}

function getmsgex($conn, $messageId, $phoneNumber)
{
    $stmt = $conn->prepare("SELECT `id`, `read_st`, `quty` FROM `push_notifications` WHERE `emp_id`=? AND `msg_id`=?");
    $stmt->bind_param("si", $phoneNumber, $messageId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        if ($result['read_st'] == 0) {
            $updateStmt = $conn->prepare("UPDATE `push_notifications` SET `read_st`=1 WHERE `emp_id`=? AND `msg_id`=?");
            $updateStmt->bind_param("si", $phoneNumber, $messageId);
        } else {
            $qty = $result['quty'] + 1;
            $updateStmt = $conn->prepare("UPDATE `push_notifications` SET `quty`=? WHERE `emp_id`=? AND `msg_id`=?");
            $updateStmt->bind_param("isi", $qty, $phoneNumber, $messageId);
        }
        $updateStmt->execute();
        return true;
    } else {
        // Insert a new record
        $insertStmt = $conn->prepare("INSERT INTO `push_notifications` (`emp_id`, `msg_id`, `quty`, `read_st`) VALUES (?, ?, 1, 1)");
        $insertStmt->bind_param("si", $phoneNumber, $messageId);
        $insertStmt->execute();
        return true;
    }
}


function newmsg($conn, $title, $message, $adminid)
{
    $dataddmsg = $conn->prepare("INSERT INTO `messenge` (`title`, `messenge`, `admin_id`) VALUES (?, ?, ?)");

    if ($dataddmsg === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $dataddmsg->bind_param("ssi", $title, $message, $adminid);

    if (!$dataddmsg->execute()) {
        die("Error executing statement: " . $dataddmsg->error);
    }

    $messageId = $dataddmsg->insert_id;
    $dataddmsg->close();
    return $messageId;
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "sendsms") {
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $messageid = isset($_POST['messageid']) ? $_POST['messageid'] : '';
    $adminId = 1;

    ##phone messageid  title message

    if ($messageid == '1') {
        $insert = newmsg($conn, $title, $message, $adminId);
        return true;
    }

    foreach ($phone as $key => $value) {
        $msgex = $conn->prepare("SELECT `id`, `read_st`, `quty` FROM `push_notifications` WHERE `emp_id`=? AND `msg_id`=?");

        $msgex->bind_param("si", $value, $messageid);
        $msgex->execute();
        $result = $msgex->get_result();
        $noofrow = $result->num_rows;
        $row = $result->fetch_assoc();
        $noofrow = $result->num_rows;


        if ($noofrow > 0) {
            if ($row['read_st'] === 0) {
                $updateStmt = $conn->prepare("UPDATE `push_notifications` SET `read_st`=1 ,`quty`=1  WHERE `emp_id`=? AND `msg_id`=?");
                $updateStmt->bind_param("si", $value, $messageid);
            } else {
                $qty = $row['quty'] + 1;
                $updateStmt = $conn->prepare("UPDATE `push_notifications` SET `quty`=? WHERE `emp_id`=? AND `msg_id`=?");
                $updateStmt->bind_param("isi", $qty, $value, $messageid);
            }
            $updateStmt->execute();
        } else {
            $insertStmt = $conn->prepare("INSERT INTO `push_notifications` (`emp_id`, `msg_id`, `quty`, `read_st`) VALUES (?, ?, 1, 1)");
            $insertStmt->bind_param("si", $value, $messageid);
            $insertStmt->execute();
        }
    }
    echo json_encode(array("status" => "success", "message" => "Message sent successfully"));
}
