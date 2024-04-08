if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "push3232") {
$phone = isset($_POST['numbers']) ? $_POST['numbers'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';
$title = isset($_POST['title']) ? $_POST['title'] : '';
$messageid = isset($_POST['massageid']) ? $_POST['massageid'] : '';


$adminId = 1;

if (empty($phone) || empty($message) || empty($title) || empty($messageid)) {
echo json_encode(['status' => 'error', 'message' => 'Missing parameters']);
exit;
}

$phoneNumbers = is_array($phone) ? $phone : explode(",", $phone);
$messageId = ($messageid == '1') ? newmsg($conn, $title, $message, $adminId) : $messageid;

foreach ($phoneNumbers as $index => $phoneNumber) {
if (!getmsgex($conn, $messageId, $phoneNumber)) {
echo json_encode(['status' => 'error', 'message' => 'Failed to send message to ' . $phoneNumber]);
exit;
}
}
echo json_encode(['status' => 'success', 'message' => 'Messages sent successfully']);
} else {
echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}