<?php


function getReferralLevels($emp_no, $conn) {
    $downwardResult = [];
    getDownwardReferralLevels($emp_no, $conn, $downwardResult);

    $upwardResult = [];
    getUpwardReferralLevels($emp_no, $conn, $upwardResult);

    return ['upward' => $upwardResult, 'downward' => $downwardResult];
}

function getDownwardReferralLevels($emp_no, $conn, &$result, $level = 2) {
    // Query to get all employees referred by the given employee number
    $sql = "SELECT employee_no FROM employee WHERE reference_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $emp_no);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        $referredEmpNo = $row['employee_no'];

        // Store the referred employee and their level
        $result[$referredEmpNo] = $level;

        // Recursively find all employees referred by this referred employee
        getDownwardReferralLevels($referredEmpNo, $conn, $result, $level + 1);
    }
    $stmt->close();
}

function getUpwardReferralLevels($emp_no, $conn, &$result, $level = 2) {
    // Find the referrer of the given employee
    $sql = "SELECT reference_id FROM employee WHERE employee_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $emp_no);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        $referrerEmpNo = $row['reference_id'];
        if ($referrerEmpNo) {
            $result[$referrerEmpNo] = $level;
            getUpwardReferralLevels($referrerEmpNo, $conn, $result, $level + 1);
        }
    }
    $stmt->close();
}


?>