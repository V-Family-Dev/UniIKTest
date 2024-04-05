<?php

function getmsg()
{
    require "../../DB/dbconfig.php";
    $sql = $conn->prepare("SELECT * FROM `messenge` WHERE `status`=1");
    $sql->execute();
    $result = $sql->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        if ($row['mid'] != 1) {
            $data[] = $row;
        }
    }
    return $data;
}


