function insertTable($conn, $data)
{
$first_name = test_input($data['first_name']);
$last_name = test_input($data['last_name']);
$nic = test_input($data['nic']);
$employee_no = test_input($data['employee_no']);
$reference_id = test_input($data['reference_id']);
$phone_no = test_input($data['phone_no']);
$whatsapp_no = test_input($data['whatsapp_no']);
$Address = test_input($data['Address']);
$postalCode = test_input($data['postalCode']);
$branchCode = test_input($data['branchCode']);
$accountHolderName = test_input($data['accountHolderName']);
$AccountNum = test_input($data['AccountNum']);

$valid = geterror($first_name, $last_name, $nic, $employee_no, $phone_no, $whatsapp_no, $Address, $postalCode, $branchCode, $accountHolderName, $AccountNum);

if ($valid['status'] === 'error') {
return $valid;
}

if (empty($reference_id)) {
$reference_id = NULL;
}

$sql = $conn->prepare("INSERT INTO `employee` (employee_no, first_name, last_name, NIC, phone_no, whatsapp_no, BankCode, Address, postcode, AccountNum, holderName, reference_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
if (!$sql) {
return array("status" => "error", "message" => "Database error: unable to prepare statement");
}
$sql->bind_param("ssssssisssss", $employee_no, $first_name, $last_name, $nic, $phone_no, $whatsapp_no, $branchCode, $Address, $postalCode, $AccountNum, $accountHolderName, $reference_id);
$sql->execute();

if ($sql->affected_rows > 0) {
$result = array("status" => "success", "message" => "Employee added successfully");
} else {
$result = array("status" => "error", "message" => "Failed to add employee");
}
$sql->close();

return $result;
}

function geterror($first_name, $last_name, $nic, $employee_no, $phone_no, $whatsapp_no, $Address, $postalCode, $branchCode, $accountHolderName, $AccountNum)
{
if (empty($first_name)) {
return array("status" => "error", "message" => "First Name is required");
}
if (empty($last_name)) {
return array("status" => "error", "message" => "Last Name is required");
}
if (empty($nic)) {
return array("status" => "error", "message" => "NIC is required");
}
if (empty($employee_no)) {
return array("status" => "error", "message" => "Employee Number is required");
}

if (empty($phone_no)) {
return array("status" => "error", "message" => "Phone Number is required");
}
if (empty($whatsapp_no)) {
return array("status" => "error", "message" => "Whatsapp Number is required");
}
if (empty($Address)) {
return array("status" => "error", "message" => "Address is required");
}
if (empty($postalCode)) {
return array("status" => "error", "message" => "Postal Code is required");
}
if (empty($branchCode)) {
return array("status" => "error", "message" => "Branch Code is required");
}
if (empty($accountHolderName)) {
return array("status" => "error", "message" => "Account Holder Name is required");
}
if (empty($AccountNum)) {
return array("status" => "error", "message" => "Account Number is required");
}

return array("status" => "success", "message" => "All fields are valid");
}


function test_input($data)
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}