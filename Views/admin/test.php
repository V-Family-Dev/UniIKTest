<?php

if (isset($_POST['sendsms'])) {
    $phone = $_POST['phone'];
    $phoneNumbers = explode(",", $phone);
    echo "<pre>";
    print_r($phoneNumbers);
    echo "</pre>";
}
