<?php
require "../../DB/dbconfig.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $emp_code = isset($_POST['emp_code']) ? $_POST['emp_code'] : '';

    $query = $conn->prepare("SELECT e.id AS 'empid',e.first_name AS 'Name', e.NIC, e.employee_no AS 'Employee No', e.phone_no AS 'Mobile Number', c.name_en AS 'City', d.name_en AS 'District', b.name AS 'Bank Name' FROM employee e INNER JOIN bankbranches bb ON e.BankCode = bb.branchID INNER JOIN banks b ON bb.bankID = b.id INNER JOIN cities c ON e.postcode = c.postcode INNER JOIN districts d ON c.district_id = d.id WHERE e.employee_no = ? ");
    $query->bind_Param('s', $emp_code);
    $query->execute();
    $result = $query->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);







    echo json_encode($data);
    /* $sql = "SELECT e.first_name AS 'Name', e.NIC, e.employee_no AS 'Employee No', e.phone_no AS 'Mobile Number',c.name_en AS 'City',d.name_en AS 'District',
    b.name AS 'Bank Name'FROM employee e  INNER JOIN bankbranches bb ON e.BankCode = bb.branchID INNER JOIN
    banks b ON bb.bankID  = b.id INNER JOIN  cities c ON e.postcode = c.postcode INNER JOIN
    districts d ON c.district_id = d.id
WHERE
    e.employee_no = 'USD0001' LIMIT 1;";*/
}
