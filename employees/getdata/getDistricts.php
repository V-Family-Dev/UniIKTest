
    <?php
    require "../../DB/dbconfig.php";
    require "../../functions/employee/employeesFunctions.php";

    header('Content-Type: application/json');


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $province_id = $_POST['provinceId'];
        $stmt = $conn->prepare("SELECT `id`, `name_en` FROM `districts` WHERE `province_id` = ?");
        $stmt->bind_param("i", $province_id);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'id' => $row['id'],
                'name_en' => $row['name_en']
            ];
        }

        $stmt->close();



        echo json_encode($data);
    }
    ?>
