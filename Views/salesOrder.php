<?php
require '../include/auth.php';
require '../functions/sales/salesFunctions.php';


?>

<form action="orderConfig.php" method="POST">
    <h2>SALES ORDER DETAILS</h2>
    <label for="getempdata">Emp Employee</label>
    <select name="getempdata" id="getempdata">
        <option value="">Select Employee</option>
        <?php
        $emp = getEmpId($conn);
        foreach ($emp as $row) {
            $datas = "data-name='" . $row['first_name'] . " " . $row['last_name'] . "'";
            $datas .= " data-number='" . $row['phone_no'] . "'";

            $datas .= " data-address='" . $row['Address'] . "'";

        ?>
            <option value="<?= $row['id']; ?>" <?= $datas; ?>><?= $row['employee_no']; ?></option>
        <?php } ?>
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
        <label for="sales-date">Sales Date</label>
        <label for="sales-date">Sales Date</label><input type="date" name="sales-date">
    </div>
    <div>
        <label for="due-date">Due Date</label>
        <input type="date" name="due-date">
    </div>

    <script>
        $(document).ready(function() {
            $('#getempdata').select2({
                placeholder: "User Emp ID",
                allowClear: true
            }).on('select2:select', function(e) {
                var selectedContactName = $(this).find(':selected').data('name');
                $('#contact-person').val(selectedContactName);
                var selectedContactNumber = $(this).find(':selected').data('number');
                $('#contact-no').val(selectedContactNumber);
                var selectedAddress = $(this).find(':selected').data('address');
                $('#address').val(selectedAddress);
            });
        });
    </script>


    <h2>SALES ORDER ITEMS</h2>

    <label for="itemcode">itemcode</label>
    <select id="itemSelect" style="width: 20%">
        <!-- Options will be dynamically loaded here -->
    </select>

    <div>
        <label for="item-name">Item Name</label>
        <input type="text" id="item-name" name="item-name" placeholder="Item Name">
    </div>
    <div>
        <label for="item-quantity">Item Quantity</label>
        <input type="text" id="item-quantity" name="item-quantity" placeholder="Item Quantity">
    </div>
    <div>
        <label for="item-price">Item Price</label>
        <input type="text" id="item-price" name="item-price" placeholder="Item Price">
    </div>
    <button id="addMore">add more</button>
    <button>submit</button>

    <script>
        $(document).ready(function() {
            var itemsData = []; // Array to hold items data for later use

            // AJAX call to fetch items data
            $.ajax({
                type: 'GET',
                url: '../salesOrder/orderConfig.php',
                contentType: false,
                processData: false,
                success: function(data) {
                    // Parse the JSON response

                    if (data.status === "success") {
                        itemsData = data.data; // Store the items data
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

            // Event listener for when an item is selected in the dropdown
            $('#itemSelect').on('select2:select', function(e) {
                var selectedItemId = $(this).val();

                // Find the selected item in the itemsData array
                var selectedItem = itemsData.find(item => item.Item_id == selectedItemId);

                if (selectedItem) {
                    // Populate the input fields
                    $('#item-name').val(selectedItem.Item_name); // Replace 'name' with the actual property name
                    // Replace 'quantity' with the actual property name
                    $('#item-price').val(selectedItem.price); // Replace 'price' with the actual property name
                }
            });
        });
        function updateTotal() {
        var total = 0;
        $('#mytable tbody tr').each(function() {
            var amount = parseFloat($(this).find('td:nth-child(5)').text()); // Assuming the amount is in the 5th column
            if (!isNaN(amount)) {
                total += amount;
            }
        });
        $('#totalAmount').text(total.toFixed(2));
    }

        $('#addMore').click(function(event) {
        event.preventDefault();
        
        // Retrieve values from the input fields
        var itemName = $('#item-name').val();
        var itemCode = $('#itemSelect').find(':selected').text();
        var itemPrice = $('#item-price').val();
        var itemQuantity = $('#item-quantity').val();
        var itemAmount = parseFloat(itemPrice) * parseInt(itemQuantity);
      
        // Append a new row to the table
        $('#mytable tbody').append(
            '<tr>' +
                '<td>' + itemName + '</td>' +
                '<td>' + itemCode + '</td>' +
                '<td>' + itemPrice + '</td>' +
                '<td>' + itemQuantity + '</td>' +
                '<td>' + itemAmount.toFixed(2) + '</td>' +
                '<td><button class="editRow">Remove</button></td>' +
            '</tr>'
        );

        // Clear the input fields
        $('#item-name').val('');
        $('#itemSelect').val(null).trigger('change'); // Reset Select2
        $('#item-price').val('');
        $('#item-quantity').val('');

        updateTotal();
        $('#mytable').on('click', '.editRow', function() {
           
            // Find the closest tr parent element and remove it
            $(this).closest('tr').remove();
            updateTotal();
        });
    });


       
    </script>

    <br><br>

    <table id="mytable" class="display" border="1px solid">
        <thead>
            <tr>
                <th>Item</th>
                <th>Item Code</th>
                <th>Unit Price </th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            <tr>

            </tr>
        </tbody>
    </table>

    <h2>Total: <span id="totalAmount">0.00</span></h2>

</form>