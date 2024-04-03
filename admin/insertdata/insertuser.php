<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../DB/dbconfig.php';
    $username = $_POST['username'];
    $password = hashs($_POST['password']);
    $checkboxValues = array();
    if (isset($_POST['myCheckbox']) && !empty($_POST['myCheckbox'])) {
        $checkboxValues = $_POST['myCheckbox'];
    }
    $stmt = $conn->prepare("INSERT INTO `admin`(`user_name`, `password`) VALUES(?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $last_id = $conn->insert_id;
    foreach ($checkboxValues as $checkboxValue) {
        $stmt = $conn->prepare("INSERT INTO `admin_privileges`(`admin_id`, `privileges_id`) VALUES(?, ?)");
        $stmt->bind_param("ii", $last_id, $checkboxValue);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo json_encode(array("message" => "Data inserted successfully"));
        } else {
            echo json_encode(array("message" => "Data not inserted"));
        }
    }
}

function hashs($password)
{
    $salt = 'amarabandurupasinghe';
    $hash = md5($salt . $password);

    for ($i = 0; $i < 1000; $i++) {
        $hash = md5($hash);
    }

    return $hash;
}
