
<?php

require_once '../functions/sales/upDownFunction.php';
require_once '../DB/dbconfig.php';
header('Content-Type: application/json');






if (isset($_GET['action']) && $_GET['action'] == 'getReferralLevels' && isset($_GET['empId'])) {
    $empId = $_GET['empId'];
    $referralLevels = getReferralLevels($empId, $conn);

    // Return the result as JSON
    echo json_encode($referralLevels);
}
$conn->close();

?>