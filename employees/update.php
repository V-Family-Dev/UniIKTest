<?php




require_once '../DB/dbconfig.php';
//require_once '../functions/employee/employeeditdunc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'updateemp') {
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $nic = isset($_POST['nic']) ? $_POST['nic'] : '';
    $employee_no = isset($_POST['employee_no']) ? $_POST['employee_no'] : '';
    $reference_id = isset($_POST['reference_id']) ? $_POST['reference_id'] : '';
    $phone_no = isset($_POST['phone_no']) ? $_POST['phone_no'] : '';
    $whatsapp_no = isset($_POST['whatsapp_no']) ? $_POST['whatsapp_no'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $postal_code = isset($_POST['postalCode']) ? $_POST['postalCode'] : '';
    $branch_code = isset($_POST['branchCode']) ? $_POST['branchCode'] : '';
    $account_holder_name = isset($_POST['accountHolderName']) ? $_POST['accountHolderName'] : '';
    $account_number = isset($_POST['AccountNum']) ? $_POST['AccountNum'] : '';
    $emp_id = isset($_POST['empsid']) ? $_POST['empsid'] : '';
    $bank_id = isset($_POST['bankcode']) ? $_POST['bankcode'] : '';

    if (updateEmployee($conn, $first_name, $last_name, $nic, $phone_no, $whatsapp_no, $branch_code, $address, $postal_code, $account_number, $account_holder_name, $emp_id, $bank_id) === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update employee']);
    } else {
        $errorInfo = $conn->error;  // Get error info from the database connection
        echo json_encode(['status' => 'success', 'message' => 'Employee updated successfully']);
    }
}


function updateEmployee($conn, $first_name, $last_name, $nic, $phone_no, $whatsapp_no, $branch_id, $address, $postal_code, $account_number, $account_holder_name, $emp_id, $bank_id)
{
    $query = $conn->prepare("UPDATE `employee` SET `first_name`=?, `last_name`=?, `NIC`=?, `phone_no`=?, `whatsapp_no`=?, `BankCode`=?, `Address`=?, `postcode`=?, `AccountNum`=?, `holderName`=? ,`bank_id`=? WHERE id=?");

    if ($query === false) {
        return false;
    }



    $query->bind_param('sssssissssii', $first_name, $last_name, $nic, $phone_no, $whatsapp_no, $branch_id, $address, $postal_code, $account_number, $account_holder_name, $bank_id, $emp_id);

    $query->execute();


    if ($query->affected_rows > 0) {
        return 1;
    } else {
        return 0;
    }
}
