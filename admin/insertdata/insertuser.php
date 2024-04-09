<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../../DB/dbconfig.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve data from POST request
        $username = $_POST['username'] ?? '';
        $password = hashs($_POST['password'] ?? '');
        $checkboxValues = $_POST['area'] ?? array();

        // Prepare and execute insertion to 'admin' table
        $stmt = $conn->prepare("INSERT INTO `admin` (`user_name`, `password`) VALUES (?, ?)");
        if (!$stmt) {
            echo json_encode(array("message" => "Failed to prepare statement"));
            exit;
        }

        $stmt->bind_param("ss", $username, $password);
        if (!$stmt->execute()) {
            echo json_encode(array("message" => "Failed to add admin"));
            exit;
        }

        $last_id = $conn->insert_id;
        $stmt->close();

        // Insert each privilege
        foreach ($checkboxValues as $checkboxValue) {
            $stmt = $conn->prepare("INSERT INTO `admin_privileges` (`admin_id`, `privileges_id`) VALUES (?, ?)");
            if (!$stmt) {
                echo json_encode(array("message" => "Failed to prepare privilege insertion"));
                exit;
            }

            $stmt->bind_param("ii", $last_id, $checkboxValue);
            if (!$stmt->execute()) {
                echo json_encode(array("message" => "Failed to add privilege"));
                exit;
            }

            $stmt->close();
        }

        // Success
        echo json_encode(array("message" => "Admin and privileges added successfully"));

        // Close connection
        $conn->close();
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
