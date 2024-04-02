<?php

require_once '../functions/sales/salesFunctions.php';
require_once '../DB/dbconfig.php';
header('Content-Type: application/json');


$getItemData=getItemData($conn);

echo json_encode(["status" => "success", "data" => $getItemData]);



