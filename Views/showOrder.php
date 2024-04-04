<?php
require '../include/auth.php';





?>

<table border="1px solid ">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Sales Date</th>
            <th>Delivery Date</th>
            <th>Return Date</th>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Item Code</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Active</th>
        </tr>
    </thead>
    <tbody id="salesOrderTable">
    </tbody>
</table>

<script>
    $(document).ready(function() {
        // Fetch all sales order details
        $.ajax({
            url: '../salesOrder/showOrderConfig.php',
            type: 'GET',
            data: {
                action: 'salesdata'
            },
            success: function(response) {
                // Check if the response is not empty
                if (response.data.length > 0) {
                    // Loop through the response and append the data to the table
                    response.data.forEach(function(data) {
                        $('#salesOrderTable').append(`
                                <tr>
                                    <td>${data.so_id}</td>
                                    <td>${data.sales_date}</td>
                                    <td>${data.delivery_date}</td>
                                    <td>${data.return_date}</td>                               
                                    <td>${data.employee_no}</td>
                                    <td>${data.first_name} ${data.last_name}</td>
                                    <td>${data.item_code}</td>
                                    <td>${data.Item_name}</td>
                                    <td>${data.price}</td>
                                    <td>${data.quantity}</td>
                                    <td>${data.so_status}</td>
                                    <td>${data.isActive}</td>
                                </tr>
                            `);
                    });
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>