<?php


// Path: functions/user/validate.php


function validateuser($conn, $empid)


{

    $idemp = $empid;
    $sql = $conn->prepare("SELECT `id` FROM `employee` WHERE `id` = ?");
    $sql->bind_param("i", $idemp);
    $sql->execute();
    $result = $sql->get_result();

    return $result->num_rows;
}
