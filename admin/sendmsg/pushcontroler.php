<?php
//require "../../functions/user/pushfunction.php";
require "../../DB/dbconfig.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "sendpush") {
    $phone = $_POST['phone'] ?? '';
    $messageId = $_POST['messageid'] ?? '';
    $title = $_POST['title'] ?? '';
    $message = $_POST['message'] ?? '';
    $adminId = 1;

    try {
        if (empty($messageId)) {
            $messageId = insertMessage($conn, $title, $message, $adminId);
        }

        $phoneNumbers = explode(",", $phone);
        foreach ($phoneNumbers as $phoneNumber) {
            processPhoneNumber($conn, $messageId, $phoneNumber);
        }

        echo json_encode(['status' => 'success', 'message' => 'Message processing completed']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

function insertMessage($conn, $title, $message, $adminId)
{
    $stmt = $conn->prepare("INSERT INTO `messenge` (`title`, `messenge`, `admin_id`) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $message, $adminId);
    $stmt->execute();
    return $conn->insert_id;
}

function processPhoneNumber($conn, $messageId, $phoneNumber)
{
    // Check if the notification for this number already exists
    $stmt = $conn->prepare("SELECT `id`, `read_st`, `quty` FROM `push_notifications` WHERE `emp_id`=? AND `msg_id`=?");
    $stmt->bind_param("si", $phoneNumber, $messageId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        // Update the existing record
        if ($result['read_st'] == 0) {
            $updateStmt = $conn->prepare("UPDATE `push_notifications` SET `read_st`=1 WHERE `emp_id`=? AND `msg_id`=?");
            $updateStmt->bind_param("si", $phoneNumber, $messageId);
        } else {
            $qty = $result['quty'] + 1;
            $updateStmt = $conn->prepare("UPDATE `push_notifications` SET `quty`=? WHERE `emp_id`=? AND `msg_id`=?");
            $updateStmt->bind_param("isi", $qty, $phoneNumber, $messageId);
        }
        $updateStmt->execute();
    } else {
        // Insert a new record
        $insertStmt = $conn->prepare("INSERT INTO `push_notifications` (`emp_id`, `msg_id`, `quty`, `read_st`) VALUES (?, ?, 1, 0)");
        $insertStmt->bind_param("si", $phoneNumber, $messageId);
        $insertStmt->execute();
    }
}
