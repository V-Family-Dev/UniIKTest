<?php

require_once '../../DB/dbconfig.php';
require_once '../../functions/employee/employeeditdunc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'getempdata') {

    $emp_code = isset($_POST['empid']) ? $_POST['empid'] : '';
    $getdata = "SELECT e.id AS 'empid', e.first_name AS 'f_Name', e.last_name AS 'l_name', e.NIC, e.employee_no AS 'Employee No', e.phone_no AS 'Mobile Number', ";
    $getdata .= "e.whatsapp_no AS 'whastapp', e.Address AS 'Address', e.AccountNum As 'ac_no', e.holderName As 'h_name', c.name_en AS 'City', d.name_en AS 'District',e.postcode AS postcode ,";
    $getdata .= "b.name AS 'Bank Name', bb.branchName,b.ID AS 'Bank_Id', bb.branchID  AS 'branch_id', p.id AS 'provinces_id',d.id AS district_id FROM employee e INNER JOIN bankbranches bb ON e.BankCode = bb.branchID ";
    $getdata .= "INNER JOIN banks b ON bb.bankID = b.ID INNER JOIN cities c ON e.postcode = c.postcode INNER JOIN districts d ON c.district_id = d.id INNER JOIN provinces p ON d.province_id = p.id ";
    $getdata .= "WHERE e.id = ?";
    $query = $conn->prepare($getdata);
    $query->bind_param('s', $emp_code);
    $query->execute();
    $result = $query->get_result();
    $data = [];
    $empIds = [];

    foreach ($result as $row) {
        $empid = $row['empid'];
        if (!in_array($empid, $empIds)) {
            $empIds[] = $empid;
            $data[] = $row;
        }
    }





    echo json_encode($data);
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

    $getdata = "SELECT `branchID`,`branchName` FROM `bankbranches`";
    $query = $conn->prepare($getdata);
    $query->execute();
    $result = $query->get_result();
    $branch = [];
    foreach ($result as $row) {
        $branch[] = $row;
    }
    echo json_encode($branch);
}
