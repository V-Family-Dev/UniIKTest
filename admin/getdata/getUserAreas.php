<?php
include '../../DB/dbconfig.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Prepare and execute query to fetch user areas
    $query = "SELECT p.area_id, p.area_name, IF(ap.admin_id IS NULL, 0, 1) AS isAccessible
              FROM privileges p
              LEFT JOIN admin_privileges ap ON p.area_id = ap.privileges_id AND ap.admin_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $areas = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($areas);
}
