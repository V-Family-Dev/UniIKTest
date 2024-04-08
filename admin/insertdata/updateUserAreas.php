<?php
include '../../DB/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userId']) && isset($_POST['areas'])) {
    $userId = $_POST['userId'];
    $areas = json_decode($_POST['areas'], true); // Assuming areas is a JSON encoded array

    // Start transaction
    $conn->begin_transaction();

    try {
        // First, remove all existing permissions for this user
        $stmt = $conn->prepare("DELETE FROM admin_privileges WHERE admin_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        // Now, insert new permissions based on received data
        $stmt = $conn->prepare("INSERT INTO admin_privileges (admin_id, privileges_id, ap_status) VALUES (?, ?, 1)");
        foreach ($areas as $area) {
            if ($area['isAccessible']) {
                $areaId = $area['id'];
                $stmt->bind_param("ii", $userId, $areaId);
                $stmt->execute();
            }
        }

        // Commit transaction
        $conn->commit();
        echo json_encode(array("status" => "success"));
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo json_encode(array("status" => "error", "message" => $e->getMessage()));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request"));
}
