<?php

require_once '../../DB/dbconfig.php';
require_once '../../functions/employee/employeeditdunc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'getempdata') {

    $emp_code = isset($_POST['empid']) ? $_POST['empid'] : '';
    $getdata = "SELECT e.id AS 'Employee ID', e.first_name AS 'First Name', e.last_name AS 'Last Name', e.NIC, e.employee_no AS 'Employee No', e.phone_no AS 'Phone Number', e.whatsapp_no AS 'WhatsApp Number', e.Address AS 'Address', e.AccountNum AS 'Account Number', e.holderName AS 'Account Holder Name', p.id AS 'Province ID', d.id AS 'District ID', c.postcode AS 'Postal Code', b.ID AS 'Bank ID', e.BankCode AS  'Branch ID' FROM employee e INNER JOIN cities c ON e.postcode = c.postcode INNER JOIN districts d ON c.district_id = d.id INNER JOIN provinces p ON d.province_id = p.id INNER JOIN bankbranches bb ON e.BankCode = bb.branchID INNER JOIN banks b ON e.bank_id = b.ID WHERE e.id = ?";

    $query = $conn->prepare($getdata);
    $query->bind_param('i', $emp_code); // Assuming emp_code is an integer
    if ($query->execute()) {
        $result = $query->get_result();
        $data = [];

        foreach ($result as $row) {
            $data[] = $row;
        }

        echo json_encode($data);
    } else {
        // Handle query error
        echo json_encode(['error' => 'Query failed']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'getpro') {

    $getdata = "SELECT `id`,`name_en` FROM `provinces`";
    $query = $conn->prepare($getdata);
    $query->execute();
    $result = $query->get_result();
    $pro = [];
    foreach ($result as $row) {
        $pro[] = $row;
    }
    echo json_encode($pro);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'getdis') {

    $getdata = "SELECT `id`,`name_en` FROM `districts`";
    $query = $conn->prepare($getdata);
    $query->execute();
    $result = $query->get_result();
    $dis = [];
    foreach ($result as $row) {
        $dis[] = $row;
    }
    echo json_encode($dis);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'getcity') {

    $getdata = "SELECT `name_en`,`postcode` FROM `cities`";
    $query = $conn->prepare($getdata);
    $query->execute();
    $result = $query->get_result();
    $city = [];
    foreach ($result as $row) {
        $city[] = $row;
    }
    echo json_encode($city);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'getbank') {


    $getdata = "SELECT `ID`,`name` FROM `banks`";
    $query = $conn->prepare($getdata);
    $query->execute();
    $result = $query->get_result();
    $bank = [];
    foreach ($result as $row) {
        $bank[] = $row;
    }
    echo json_encode($bank);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'getbranch') {

    $query = $conn->prepare("SELECT `branchID`,`branchName`,`bankID` FROM `bankbranches`");

    $query->execute();

    $result = $query->get_result();
    $branch = [];
    foreach ($result as $row) {
        $branch[] = $row;
    }
    echo json_encode($branch);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'getbranchs') {
    $bankid = isset($_POST['bankID']) ? $_POST['bankID'] : '';

    $getdata = "SELECT `branchID`,`branchName` FROM `bankbranches` WHERE `bankID`= ?";

    $query = $conn->prepare($getdata);
    $query->bind_param('i', $bankid);
    $query->execute();
    $result = $query->get_result();
    $branch = [];
    foreach ($result as $row) {
        $branch[] = $row;
    }
    echo json_encode($branch);
}
