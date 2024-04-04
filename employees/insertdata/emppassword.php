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
