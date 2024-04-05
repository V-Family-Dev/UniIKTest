<?php
require "../../DB/dbconfig.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === "search") {
    $emp_code = isset($_POST['emp_code']) ? $_POST['emp_code'] : '';



    $emp_code = '%' . $emp_code . '%';

    $query = $conn->prepare("SELECT e.id AS 'empid', e.first_name AS 'Name', e.NIC, e.employee_no AS 'Employee No', e.phone_no AS 'Mobile Number', c.name_en AS 'City', d.name_en AS 'District', b.name AS 'Bank Name' FROM employee e INNER JOIN bankbranches bb ON e.BankCode = bb.branchID INNER JOIN banks b ON bb.bankID = b.id INNER JOIN cities c ON e.postcode = c.postcode INNER JOIN districts d ON c.district_id = d.id WHERE e.employee_no LIKE ? AND e.EmpStatus=1");
    $query->bind_Param('s', $emp_code);
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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === "inactive") {

    $query = $conn->prepare("SELECT e.id AS 'empid', e.first_name AS 'Name', e.NIC, e.employee_no AS 'Employee No', e.phone_no AS 'Mobile Number', c.name_en AS 'City', d.name_en AS 'District', b.name AS 'Bank Name' FROM employee e INNER JOIN bankbranches bb ON e.BankCode = bb.branchID INNER JOIN banks b ON bb.bankID = b.id INNER JOIN cities c ON e.postcode = c.postcode INNER JOIN districts d ON c.district_id = d.id WHERE e.EmpStatus=0");
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



if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === "activate") {
    $empid = !empty($_POST['empid']) ? $_POST['empid'] : "";

    if (empty($empid)) {
        $response = array('status' => 'error', 'message' => 'Employee ID is missing');
    } else {
        $query = $conn->prepare("UPDATE `employee` SET `EmpStatus`='1' WHERE `employee_no` = ?");
        $query->bind_param("s", $empid);

        if ($query->execute()) {
            if ($query->affected_rows > 0) {
                $loginblock = $conn->prepare("UPDATE `employee_login` SET `user_status`='1' WHERE `employee_no`=?");
                $loginblock->bind_param("s", $empid);
                $loginblock->execute();
                if ($loginblock->affected_rows > 0) {
                    $response = array('status' => 'success', 'message' => 'Employee activated successfully');
                }
            } else {
                $response = array('status' => 'error', 'message' => 'No employee found with the given ID');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Error executing the activate query');
        }

        $query->close();
    }

    echo json_encode($response);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === "delete") {
    $empid = !empty($_POST['empid']) ? $_POST['empid'] : null;

    if ($empid) {



        $loginblock = $conn->prepare("DELETE FROM `employee` WHERE `employee_no`=?");
        $loginblock->bind_param("s", $empid);
        $loginblock->execute();
        if ($loginblock->affected_rows > 0) {
            $loginblock = $conn->prepare("DELETE FROM `employee_login` WHERE `employee_no`=?");
            $loginblock->bind_param("s", $empid);
            $loginblock->execute();
            if ($loginblock->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Employee deleted successfully');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'No employee found with the given ID');
        }


        $query->close();
    } else {
        $response = array('status' => 'error', 'message' => 'Employee ID is missing');
    }
    echo json_encode($response);
}
