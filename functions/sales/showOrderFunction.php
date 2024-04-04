<?php

function getAllSalesOrderDetails($conn)
{
    // SQL query
    $sql = "SELECT 
                s.so_id,
                s.sales_date,
                s.delivery_date,
                s.return_date,
                e.employee_no,
                e.first_name,
                e.last_name,
                i.item_code,
                i.Item_name,
                i.price,
                ims.quantity,
                s.so_status,
                s.isActive
            FROM 
                salesorder s
                JOIN employee e ON s.emp_no = e.id
                JOIN itemmaster_salesorder ims ON s.so_id = ims.salesorder_id
                JOIN item_master i ON ims.itemmaster_id = i.Item_id";

    // Execute the query
    $result = $conn->query($sql);

    // Check if query was successful
    if ($result) {
        // Fetch all rows
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $data = [];
    }

    // Return the fetched data
    return $data;
}



