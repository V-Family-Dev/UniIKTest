<?php




require_once '../DB/dbconfig.php';
require_once '../functions/employee/employeeditdunc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $nic = isset($_POST['nic']) ? $_POST['nic'] : '';
    $employee_no = isset($_POST['employee_no']) ? $_POST['employee_no'] : '';
    $reference_id = isset($_POST['reference_id']) ? $_POST['reference_id'] : '';
    $phone_no = isset($_POST['phone_no']) ? $_POST['phone_no'] : '';
    $whatsapp_no = isset($_POST['whatsapp_no']) ? $_POST['whatsapp_no'] : '';
    $address = isset($_POST['Address']) ? $_POST['Address'] : '';
    $province = isset($_POST['province']) ? $_POST['province'] : '';
    $districts = isset($_POST['districts']) ? $_POST['districts'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $postal_code = isset($_POST['postalCode']) ? $_POST['postalCode'] : '';
    $branch_code = isset($_POST['branchCode']) ? $_POST['branchCode'] : '';
    $account_holder_name = isset($_POST['accountHolderName']) ? $_POST['accountHolderName'] : '';
    $account_number = isset($_POST['AccountNum']) ? $_POST['AccountNum'] : '';
    $emp_id = isset($_POST['empsid']) ? $_POST['empsid'] : '';

    if (updateEmployee($conn, $emp_id, $first_name, $last_name, $nic, $employee_no, $phone_no, $whatsapp_no, $address,  $postal_code, $branch_code, $account_holder_name, $account_number, $reference_id)) {
        echo json_encode(['status' => 'success', 'message' => 'Employee updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update employee']);
    }
}

















