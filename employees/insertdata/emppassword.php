<?php
require "../../functions/employee/employeesFunctions.php";
require "../../DB/dbconfig.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "emppassword") {
    $empid = !empty($_POST['empid']) ? $_POST['empid'] : '';


    if (empty($empid)) {
        echo json_encode(["status" => "error", "message" => "Both Employee ID and Password are required"]);
        exit;
    }


    $password = password();


    $sql = $conn->prepare("UPDATE `employee_login` SET `password`=? WHERE `employee_no`=?");
    $sql->bind_param("ss", $password, $empid);

    if ($sql->execute()) {
        echo json_encode(["status" => "success", "message" => "Password Changed"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to change password"]);
    }
    $sql->close();
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['action']) && $_POST['action'] == "deleteemp") {
    $empid = !empty($_POST['empid']) ? $_POST['empid'] : null;

    if ($empid) {
        $query = "UPDATE `employee` SET `EmpStatus`='0' WHERE `employee_no` = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $empid);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $loginblock = $conn->prepare("UPDATE `employee_login` SET `user_status`='0' WHERE `employee_no`=?");
                    $loginblock->bind_param("s", $empid);
                    $loginblock->execute();
                    if ($loginblock->affected_rows > 0) {
                        $response = array('status' => 'success', 'message' => 'Employee deleted successfully');
                    }
                } else {
                    $response = array('status' => 'error', 'message' => 'No employee found with the given ID');
                }
            } else {
                $response = array('status' => 'error', 'message' => 'Error executing the delete query');
            }

            $stmt->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Error preparing the delete query');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Employee ID is missing');
    }
    echo json_encode($response);
}
