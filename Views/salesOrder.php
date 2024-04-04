<?php
require '../include/auth.php';
// require '../functions/sales/salesFunctions.php';


?>

<form action="../salesOrder/orderConfig.php" method="POST">
    <h2>SALES ORDER DETAILS</h2>
    <label for="getempdata">Emp Employee</label>
    <select name="getempdata" id="getempdata" style="width: 20%">


    </select>
    <div><label for="Contact-Person">Contact Person</label>
        <input type="text" id="contact-person" name="contact-person" placeholder="Contact Person">
    </div>
    <div>
        <label for="Contact-No">Contact No</label>
        <input type="text" id="contact-no" name="contact-no" placeholder="Contact No">
    </div>

    <label for="address">address</label>
    <textarea id="address" name="address" rows="3" placeholder="Address"></textarea>

    <div>

        <label for="sales-date">Sales Date</label><input type="date" id="date" name="sales-date">
    </div>


    <h2>SALES ORDER ITEMS</h2>

    <label for="itemcode">itemcode</label>
    <select id="itemSelect" style="width: 20%">
        <!-- Options will be dynamically loaded here -->
    </select>
    <input type="hidden" id="selected-item-id">
    <div>
        <label for="item-name">Item Name</label>
        <input type="text" id="item-name" name="item-name" placeholder="Item Name">
    </div>
    <div>
        <label for="item-quantity">Item Quantity</label>
        <input type="text" id="item-quantity" name="item-quantity" placeholder="Item Quantity" required>
    </div>
    <div>
        <label for="item-price">Item Price</label>
        <input type="text" id="item-price" name="item-price" placeholder="Item Price">
    </div>
    <button id="addMore">add more</button>
    <button id="submitOrder">submit</button>

    <br><br>

    <table id="mytable" class="display" border="1px solid">
        <thead>
            <tr>
                <td>ItemId</td>
                <td>ItemCode</td>
                <td>Item Name</td>
                <td>Unit Price </td>
                <td>Quantity</td>
                <td>Amount</td>
                <td>Remove</td>
            </tr>
        </thead>
        <tbody>
            <tr>

            </tr>
        </tbody>
    </table>

    <h2>Total: <span id="totalAmount">0.00</span></h2>

</form>

<script>
    $(document).ready(function() {
        var empData = []; // Array to hold employee data

        // AJAX call to fetch employee data
        $.ajax({
            type: 'GET',
            url: '../salesOrder/orderConfig.php',
            data: {
                action: 'empdata'
            },
            // contentType: 'application/json',
            success: function(data) {
                if (data.status === "success") {
                    empData = data.data; // Store the employee data
                    $('#getempdata').append($('<option>', {
                        value: '',
                        text: '',
                        disabled: true, // disable the placeholder option
                        hidden: true, // hide the placeholder option
                        selected: true // make it the selected option
                    }));
                    empData.forEach(function(item) {
                        $('#getempdata').append(new Option(item.employee_no, item.id));
                    });

                    // Initialize Select2
                    $('#getempdata').select2({
                        placeholder: "Select an Employee",
                        allowClear: true
                    });
                } else {
                    console.error("Data fetch failed with status:", data.status);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error in AJAX call:', textStatus, errorThrown);
            }
        });

        // Event listener for when an employee is selected in the dropdown
        $('#getempdata').on('select2:select', function(e) {
            var selectedEmployeeId = $(this).val();

            // Find the selected employee in the empData array
            var selectedEmployee = empData.find(emp => emp.id == selectedEmployeeId);

            if (selectedEmployee) {
                // Populate the input fields
                $('#contact-person').val(selectedEmployee.first_name); // Assuming 'first_name' is a property
                $('#contact-no').val(selectedEmployee.phone_no);
                $('#address').val(selectedEmployee.Address); // Assuming 'phone_no' is a property
                // Assuming 'phone_no' is a property
                // Populate other fields as necessary
            }
        });
    });

    var itemsData = []; // Array to hold items data for later use

    // AJAX call to fetch items data
    $.ajax({
        type: 'GET',
        url: '../salesOrder/orderConfig.php',
        data: {
            action: 'itemdata'
        },
        // contentType: 'application/json',
        success: function(data) {
            // Parse the JSON response

            if (data.status === "success") {
                itemsData = data.data; // Store the items data
                $('#itemSelect').append($('<option>', {
                    value: '',
                    text: '', // no text needed as it's a hidden placeholder
                    disabled: true, // disable the placeholder option
                    hidden: true, // hide the placeholder option
                    selected: true // make it the selected option
                }));
                itemsData.forEach(function(item) {
                    $('#itemSelect').append(new Option(item.item_code, item.Item_id));
                });

                // Initialize Select2
                $('#itemSelect').select2({
                    placeholder: "Select an item",
                    allowClear: true
                });
            } else {
                console.error("Data fetch failed with status:", data.status);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error in AJAX call:', textStatus, errorThrown);
        }
    });
    $('#itemSelect').on('select2:select', function(e) {
        var selectedItemId = $(this).val();
        var selectedItem = itemsData.find(item => item.Item_id == selectedItemId);
        if (selectedItem) {
            $('#item-name').val(selectedItem.Item_name);
            $('#item-price').val(selectedItem.price);
            $('#selected-item-id').val(selectedItem.Item_id);

            // Set the hidden input value
        }
    });



    function updateTotal() {
        var total = 0;
        $('#mytable tbody tr').each(function() {
            var amount = parseFloat($(this).find('td:nth-child(6)').text()); // Assuming the amount is in the 5th column
            if (!isNaN(amount)) {
                total += amount;
            }
        });
        $('#totalAmount').text(total.toFixed(2));
    }

    $('#addMore').click(function(event) {
        event.preventDefault();

        // Retrieve values from the input fields and dropdown
        var itemId = $('#selected-item-id').val(); // Get the hidden item ID
        var itemCode = $('#itemSelect').find(':selected').text();
        var itemName = $('#item-name').val();
        var itemQuantity = $('#item-quantity').val();
        var itemPrice = $('#item-price').val();
        var itemAmount = parseFloat(itemPrice) * parseInt(itemQuantity);

        // Append a new row to the table
        $('#mytable tbody').append(
            '<tr>' +
            '<td  class="itemCode">' + itemId + '</td>' + // Include Item ID
            '<td>' + itemCode + '</td>' +
            '<td>' + itemName + '</td>' + // Include Item Name
            '<td>' + itemPrice + '</td>' +
            '<td class="itemQuantity">' + itemQuantity + '</td>' +
            '<td>' + itemAmount.toFixed(2) + '</td>' +
            '<td><button class="editRow">Remove</button></td>' + // Include Remove button
            '</tr>'
        );

        updateTotal();
        // Clear the input fields after adding
        $('#item-name').val('');
        $('#selected-item-id').val();
        $('#itemSelect').val(null).trigger('change');
        $('#item-price').val('');
        $('#item-quantity').val('');
        $('#mytable').on('click', '.editRow', function() {

            // Find the closest tr parent element and remove it
            $(this).closest('tr').remove();
            updateTotal();
        });

    });

    function sendOrderData(empId, date, total, orderData) {
        $.ajax({
            type: 'POST',
            url: '../salesOrder/orderConfig.php', // Update with the correct path
            data: {
                action: 'submitOrder',
                employeeId: empId,
                orderDate: date,
                totalearning: total,
                orderData: orderData,


            },
            success: function(response) {
                // Handle the response from the server
                if (response.status === 'success') {
                    alert('Order submitted successfully');
                } else {
                    console.error('Order submission failed:', response.message);
                }
                clearFormFields();
            },
            error: function(xhr, status, error) {
                // Handle any errors
                console.error('Submission error:', error);
            }
        });
    }

    function clearFormFields() {
        // Reset input fields
        $('#item-name').val('');
        $('#date').val('');
        $('#item-quantity').val('');
        $('#item-price').val('');
        $('#totalAmount').text('0.00');

        // Reset Select2 dropdowns
        $('#getempdata').val(null).trigger('change');
        $('#itemSelect').val(null).trigger('change');

        // Clear the table
        $('#mytable tbody').empty();

        // Reset additional employee detail fields
        $('#contact-person').val(''); // Clear contact person field
        $('#contact-no').val(''); // Clear contact number field
        $('#address').val('');

        // Reset any other fields as necessary
    }

    $('#submitOrder').click(function(event) {
        event.preventDefault();
        var empId = $('#getempdata').val();
        var date = $('#date').val();
        var total = $('#totalAmount').text();
        var orderData = [];
        $('#mytable tbody tr').each(function() {
            // var rowHtml = $(this).html(); // Log the HTML of the row
            // console.log('Row HTML:', rowHtml); // This should show you the structure of the row being processed


            var itemCode = $(this).find('.itemCode').text();
            var itemQuantity = $(this).find('.itemQuantity').text();

            if (itemCode !== '' && itemQuantity !== '') {
                orderData.push({
                    itemCode: itemCode,
                    itemQuantity: itemQuantity
                });
            }

        });
        if (orderData.length > 0) {
            console.log('Submitting order data:', empId, date, total, orderData);
            sendOrderData(empId, date, total, orderData); // Pass both employee ID and order data to the function
        } else {
            console.log('No items to submit');
        }
        // Rest of your code...
    });
</script>