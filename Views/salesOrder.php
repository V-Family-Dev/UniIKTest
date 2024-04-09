<?php
require '../include/auth.php';
// require '../functions/sales/salesFunctions.php';


?>






<div class="wrapper">

    <!-- Sidebar -->
    <nav class="sidebar">

        <!-- close sidebar menu -->

        <div class="m-1">
            <h3></h3>
        </div>

        <ul class="list-unstyled menu-elements">
            <li class="">
                <h4 class="ml-4">Menu</h4>
                <div class="dismiss">
                    <i class="fas fa-times"></i>
                </div>

            </li>
            <li>
                <a href="#EM" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="EM">
                    <i class="fas fa-user-plus"></i>Employee Master
                </a>
                <ul class="collapse list-unstyled" id="EM">
                    <li>
                        <a href="Create Employee.html">Create Employee</a>
                    </li>
                    <li>
                        <a href="Search Employee.html">Search Employee</a>
                    </li>
                    <li>
                        <a href="Manage Employee.html">Manage Employee</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#CM" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="CM">
                    <i class="fas fa-calculator"></i>Item Master
                </a>
                <ul class="collapse list-unstyled" id="CM">
                    <li>
                        <a href="Items.html">Items</a>
                    </li>
                    <li>
                        <a href="Payments.html">Payments</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#SM" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="SM">
                    <i class="fas fa-receipt"></i>Sales Management
                </a>
                <ul class="collapse list-unstyled" id="SM">
                    <li>
                        <a href="Create Sale Order.html">Create Sale Order</a>
                    </li>
                    <li>
                        <a href="Search Sale Orders.html">Search Sale Orders</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#rPort" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="rPort">
                    <i class="fas fa-file"></i>Reports
                </a>
                <ul class="collapse list-unstyled" id="rPort">
                    <li>
                        <a href="Create Sale Order.html">Create Sale Order</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#sendSMS" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="sendSMS">
                    <i class="fas fa-user"></i>Send SMS
                </a>
                <ul class="collapse list-unstyled" id="sendSMS">
                    <li>
                        <a href="SMS by UserID.html">SMS by UserID</a>
                    </li>
                    <li>
                        <a href="SMS by Mobile No.html">SMS by Mobile No.</a>
                    </li>
                    <li>
                        <a href="Push Notification.html">Push Notification</a>
                    </li>
                </ul>
            </li>
        </ul>

    </nav>
    <div class="overlay"></div>
    <div class="content">
        <nav id="naviBar" class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <i class="fas fa-angle-double-right fa-sm mr-3 text-light open-menu" style="cursor:pointer;"></i>
                <span class="comName">Dashboard</span>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="fas fa-user"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="naviIcon">
                        </li>
                        <li class="naviIcon">
                            <i class="fa fa-calendar fa-lg mr-2" style="font-size: 18px;"></i>
                            <span id="currentDate" class="bd-highlight align-self-center">[Current date]</span>
                        </li>
                        <li class="naviIcon ml-2">
                            <div class="mr-2 ml-2">
                                <div>
                                    <span style="font-size: 15px;">Marley Botosh</span>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <span style="font-size: 11px;">Administrator</span>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown naviIcon ml-2">
                            <a class="noUnderline dropdown-toggle d-flex align-items-center ml-2" href="#" id="navbarDropdownProfile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle" style="font-size: 23px;"></i>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                    <a class="dropdown-item" href="#">Logout</a>
                                </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>

    <form>
        <div class="first-content">
            <div class="container-fluid">
                <div class="row pt-5 pl-3 pr-3">

                    <h5 class="mb-1">Create Sale Order</h5>

                    <div class="col-12 backTheam cRound p-4">
                        <div class="row">
                            <div class="col-3">
                                <label for="getempdata" class="form-label">Sales Employee ID</label>
                                <div class="inputBox">
                                    <select class="inputBox" id="getempdata">

                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="contPerson" class="form-label">Contact Person</label>
                                <input type="text" class="inputBox" id="contact-person" name="contPerson" placeholder="Contact Person" readonly>
                            </div>
                            <div class="col-3">
                                <label for="mobNumber" class="form-label">Mobile Number</label>
                                <input type="text" class="inputBox" id="contact-no" name="mobNumber" placeholder="Mobile Number" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <label for="address" class="form-label">Address</label>
                                <div class="input-group">
                                    <textarea id="address" name="address" class="form-control textArea" rows="3" cols="50" style="width: calc(100% - 2rem);"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <label for="saleDate" class="form-label">Sale Date</label>
                                <input type="date" class="inputBox" id="date" name="sales-date">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------------------------------------------ First Content End ------------------------------------------------------------>

        <!------------------------------------------------------------ Second Section Start ------------------------------------------------------------>

        <div class="container-fluid">
            <div class="row p-3">

                <h5 class="mb-1">Sale Order Items</h5>

                <div class="col-12 backTheam cRound p-4" style="background-color: rgb(223, 222, 222);">
                    <div class="row">
                        <div class="col-3">
                            <label for="itemCode" class="form-label">Item Code</label>
                            <div class="inputBox">
                                <select class="inputBox" id="itemSelect">

                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="itemName">Item Name</label>

                            <input type="text" class="inputBox" id="item-name" name="item-name" placeholder="Item Name">

                        </div>
                        <div class="col-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="text" class="inputBox" id="item-quantity" name="item-quantity" placeholder="Quantity">
                        </div>
                        <div class="col-3">
                            <label for="item-price" class="form-label">Price</label>
                            <input type="text" class="inputBox" id="item-price" name="item-price" placeholder="Price">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col mt-4 d-flex justify-content-start">
                            <input class="btnInit btnGreen text-light" type="submit" id="addMore" name="Add more" value="Add more">
                            <input class="btnInit btnCream2" type="submit" id="submitOrder" name="Submit" value="Submit">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col mt-3">
                            <table id="mytable" class="display table table-hover backTheam m-0">
                                <thead>
                                    <tr style="background-color: #b4b3b3">
                                        <th scope="col">Item ID</th>
                                        <th scope="col">Item Code</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mr-5">
                                <div class="mr-5 pr-5">
                                    <h4 style="color: rgb(212, 0, 0);">Total Amount:<span id="totalAmount">0.00</span> &emsp;</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </form>

</div>
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
                if (response.status === "success") {
                    // Using SweetAlert for success message
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        var rowToUpdate = $('#itemRow_' + id);
                        rowToUpdate.remove();
                    });
                } else {
                    // Using SweetAlert for error message
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
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

            sendOrderData(empId, date, total, orderData); // Pass both employee ID and order data to the function

            // Optionally, show a SweetAlert message here if appropriate
            Swal.fire({
                title: 'Order Submitted!',
                text: 'Your order has been submitted successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        } else {
            Swal.fire({
                title: 'No Items',
                text: 'No items to submit.',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        }
        // Rest of your code...
    });
</script>