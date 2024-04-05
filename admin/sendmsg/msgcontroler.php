<?php
require "../../DB/dbconfig.php";
require "../../functions/user/msgfuntion.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "getmsgdata") {
    $mid = !empty($_POST['mid']) ? $_POST['mid'] : '';
    $sql = $conn->prepare("SELECT * FROM `messenge` WHERE `status`=1 AND `mid`=?");
    $sql->bind_param("i", $mid);
    $sql->execute();
    $result = $sql->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "getmsg" || $_POST['action'] == "sendpush") {
    $sql = $conn->prepare("SELECT * FROM `messenge` WHERE `status`=1");

    $sql->execute();
    $result = $sql->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
    exit;
}



if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "sendsmss") {
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : '';
    $messageid = !empty($_POST['massageid']) ? $_POST['massageid'] : '';
    $title = !empty($_POST['title']) ? $_POST['title'] : '';
    $message = !empty($_POST['message']) ? $_POST['message'] : '';
    $type = !empty($_POST['type']) ? $_POST['type'] : '';
    $adminid = 1;

    if ($messageid == '1') {
        $dataddmsg = $conn->prepare("INSERT INTO `messenge` (`title`, `messenge`, `admin_id`) VALUES (?, ?, ?)");

        if ($dataddmsg === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $dataddmsg->bind_param("ssi", $title, $message, $adminid);

        if (!$dataddmsg->execute()) {
            die("Error executing statement: " . $dataddmsg->error);
        }

        $messageId = $dataddmsg->insert_id;
    } else {
        $messageId = $messageid;
    }

    $phoneNumbers = explode(",", $phone);
    if (empty($phoneNumbers)) {
        echo json_encode(['status' => 'error', 'message' => 'No phone numbers or IDs provided']);
        exit;
    }

    $smsData = [];
    foreach ($phoneNumbers as $index => $phoneNumber) {
        if ($type == 'Phone') {
            $smsData[] = createSMSData($index, $messageId, $phoneNumber, $title, $message, $type);
        } elseif ($type == 'id') {
            $stmt = $conn->prepare("SELECT `phone_no` FROM `employee` WHERE `employee_no` = ?");
            $stmt->bind_param("s", $phoneNumber);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $employeePhone = $row['phone_no'];
                $smsData[] = createSMSData($index, $messageId, $employeePhone, $title, $message, $type);
            }
        }
    }


    $json_data = json_encode($smsData, JSON_PRETTY_PRINT);
    $detdatetime = date("Y-m-d-h-i-sa");
    $filename = "$detdatetime.json";
    file_put_contents($filename, $json_data);

    $result = addsendmsgdata($conn, $filename, $adminid, $messageId);
    echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

function addsendmsgdata($conn, $filename, $adminid, $messageId)
{
    $stmt = $conn->prepare("INSERT INTO `send_messenge` (`type`, `messenge_id`, `admin_id`, `file_name`) VALUES (1, ?, ?, ?)");
    if (!$stmt) {

        return ['success' => false, 'error' => $conn->error];
    }

    $stmt->bind_param("iis", $messageId, $adminid, $filename);
    if (!$stmt->execute()) {
        return ['success' => false, 'error' => $stmt->error];
    }

    $stmt->close();
    return ['success' => true];
}


function createSMSData($index, $messageId, $phoneNumber, $title, $message, $type)
{
    return [
        'id' => $index + 1,
        'msg_id' => $messageId,
        'phone_no' => $phoneNumber,
        'title' => $title,
        'message' => $message,
        'type' => $type
    ];
}

$conn->close();
