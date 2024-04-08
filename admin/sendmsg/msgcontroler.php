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






if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "sendmsgnew") {
    (isset($_POST['numbers']) && !empty($_POST['numbers'])) ? $phone = $_POST['numbers'] : $phone = '';
    (isset($_POST['message']) && !empty($_POST['message'])) ? $message = $_POST['message'] : $message = '';
    (isset($_POST['title']) && !empty($_POST['title'])) ? $title = $_POST['title'] : $title = '';
    (isset($_POST['type']) && !empty($_POST['type'])) ? $type = $_POST['type'] : $type = '';

    (isset($_POST['massageid']) && !empty($_POST['massageid'])) ? $messageid = $_POST['massageid'] : $messageid = '';
    $adminid = 1;  // admin session id
    $errar = array();

    if (empty($phone)) {
        echo json_encode(['status' => 'error', 'message' => '   Please enter a phone number Or Employee ID']);
        exit;
    }
    if (empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter a message']);
        exit;
    }
    if (empty($title)) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter a title']);
        exit;
    }
    if (empty($type)) {
        echo json_encode(['status' => 'error', 'message' => 'Please select a type']);
        exit;
    }
    if (empty($messageid)) {
        echo json_encode(['status' => 'error', 'message' => 'Please select a message']);
        exit;
    }
    if (is_array($phone)) {
        $phoneNumbers = $phone;
    } else {
        $phoneNumbers = explode(",", $phone);
    }


    if ($messageid == '1') {
        $messageId = newmsg($conn, $title, $message, $adminid);
    } else {
        $messageId = $messageid;
    }
    $smsData = [];
    foreach ($phoneNumbers as $index => $phoneNumber) {

        if ($type == 'phoneNumber') {

            $smsData[] = createSMSData($index, $messageId, $phoneNumber, $title, $message, $type);
        } elseif ($type == 'employeeID') {
            $idtoPhone = getnoid($conn, $phoneNumber);
            if ($idtoPhone) {
                $smsData[] = createSMSData($index, $messageId, $idtoPhone, $title, $message, $type);
            } else {
                $errar = array('status' => 'error', 'message' => 'Employee ID not found' . $phoneNumber);
                exit;
            }
        }
    }
    $json_data = json_encode($smsData, JSON_PRETTY_PRINT);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "JSON encoding error: " . json_last_error_msg();
    }
    $detdatetime = date("Y-m-d-h-i-sa");
    $filename = '../files/' . $detdatetime . '.json';

    file_put_contents($filename, $json_data);
    $result = addsendmsgdata($conn, $filename, $adminid, $messageId);

    if ($result['success']) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully ']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error sending message Please try again']);
    }
}
function getnoid($conn, $phone)
{
    $stmt = $conn->prepare("SELECT `phone_no` FROM `employee` WHERE `employee_no` = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $employeePhone = $row['phone_no'];
        return $employeePhone;
    }
    return false;
    $stmt->close();
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
        'id' => $index + 1, // Using the provided index
        'msg_id' => $messageId,
        'phone_no' => $phoneNumber,
        'title' => $title,
        'message' => $message,
        'type' => $type
    ];
}
