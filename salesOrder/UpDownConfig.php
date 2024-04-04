
<?php

require_once '../functions/sales/upDownFunction.php';
require_once '../DB/dbconfig.php';
header('Content-Type: application/json');






$referralLevels = getReferralLevels("USC0024", $conn);

echo "Upward Referral Levels:\n";
print_r($referralLevels['upward']);

echo "Downward Referral Levels:\n";
print_r($referralLevels['downward']);

$conn->close();

?>