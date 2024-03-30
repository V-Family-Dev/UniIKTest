<?php
require_once "../include/auth.php";
?>


<div class="item-creation">
    <h2>ITEM CREATION</h2>
    <form id="itemCreationForm" action="itemConfig.php" method="POST">
        <input type="text" id="itemCode" name="itemCode" placeholder="Item Code">
        <input type="text" id="itemName" name="itemName" placeholder="Item name">
        <input type="text" id="price" name="price" placeholder="Price">
        <input type="text" id="price" name="level_1" placeholder="Level 1">
        <input type="text" id="price" name="level_2" placeholder="Level 2">
        <input type="text" id="price" name="level_3" placeholder="Level 3">
        <input type="text" id="price" name="level_4" placeholder="Level 4">
        <input type="text" id="price" name="level_5" placeholder="Level 5">
        <input type="text" id="price" name="level_6" placeholder="Level 6">

        <button type="submit" name="addNewItem" class="create-btn">Create Item</button>

    </form>
</div>

<script>
    $(document).ready(function() {
        $("#itemCreationForm").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "../item/itemConfig.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    try {
                        if (data.status === "success") {
                            alert(data.message);
                            document.getElementById('itemCreationForm').reset();
                        } else {
                            // Display error message
                            alert(data.message); // Or highlight the fields in the form
                        }

                    } catch (e) {
                        console.error("Parsing error:", e);
                        alert("An error occurred while processing the response.");
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    alert("Failed to submit form. Please try again. Error: " + error);
                }
            });
        });
    });
</script>



<div class="item-list">
    <h2>ITEMS</h2>
    <button type="button" class="load-active-btn" id="fetchActiveButton">Load Active Items</button>
    <button type="button" class="load-inactive-btn" id="fetchInactiveButton">Load Inactive Items</button>

    <table id="activeItemsTable" border="1px">
        <thead>
            <tr>
                <th>#</th>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Item Price</th>
                <th>Level 1</th>
                <th>Level 2</th>
                <th>Level 3</th>
                <th>Level 4</th>
                <th>Level 5</th>
                <th>Level 6</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>

    </table>
</div>
<script>
    $(document).ready(function() {
        $('#fetchActiveButton').click(function() {
            fetchItems(1, true); // 1 for active items
        });

        $('#fetchInactiveButton').click(function() {
            fetchItems(0, false); // 0 for inactive items
        });

        function fetchItems(itemStatus, isActive) {
            $.ajax({
                url: '../item/itemConfig.php',
                type: 'GET',
                data: {
                    action: 'getItems',
                    status: itemStatus
                    // Other data for insertion...
                },
                // dataType: 'json',
                success: function(response) {
                    if (response.status === "success") {
                        
                        var tableContent = '';
                        $.each(response.data, function(index, item) {
                            var buttonText = item.item_status === 1 ? 'Deactivate' : 'Activate';
                            var buttonClass = item.item_status === 1 ? 'deactivateBtn' : 'activateBtn';
                            var newStatus = item.item_status === 1 ? 0 : 1;
                            tableContent += '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + item.item_code + '</td>' +
                                '<td>' + item.Item_name + '</td>' +
                                '<td>' + item.price + '</td>' +
                                '<td>' + item.level_1 + '</td>' +
                                '<td>' + item.level_2 + '</td>' +
                                '<td>' + item.level_3 + '</td>' +
                                '<td>' + item.level_4 + '</td>' +
                                '<td>' + item.level_5 + '</td>' +
                                '<td>' + item.level_6 + '</td>' +
                                '<td>' +
                                (isActive ? '<button class="editBtn" data-id="' + item.Item_id + '">Edit</button>' : '') +
                                '<button class="' + buttonClass + '" data-id="' + item.Item_id + '" data-status="' + newStatus + '">' + buttonText + '</button>' +
                                '</td>' + 
                                '</tr>';
                        });
                        $('#activeItemsTable tbody').html(tableContent);
                    } else {
                      
                        alert(response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error: ' + textStatus + ' - ' + errorThrown);
                    alert('Error: ' + textStatus + ' - ' + errorThrown);
                }
            });
        };
    });

    $(document).on('click', '.deactivateBtn, .activateBtn', function() {
        var id = $(this).data('id');
        var newStatus = $(this).data('status');

        $.ajax({
            url: '../item/itemConfig.php',
            type: 'POST',
            data: {
                action: 'toggleStatus',
                id: id,
                newStatus: newStatus
            },
            success: function(response) {
                if (response.status === "success") {
                    console.log("Operation successful:", response.message);
                    alert(response.message);
                }  else {
                    
                    console.log("Error:", response.message);
                    alert(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                
               
            }
        });
    });
</script>
<!-- <script>
 $(document).ready(function() {
        // Load Active Items
        $(".load-active-btn").click(function() {
            $.ajax({
                url: "itemConfig.php",
                type: "POST",
                data: {
                    loadActive: 1
                },
                success: function(data) {
                    $("#mytable").html(data);
                }
            });
        });

        // Load Inactive Items
        $(".load-inactive-btn").click(function() {
            $.ajax({
                url: "itemConfig.php",
                type: "POST",
                data: {
                    loadInactive: 1
                },
                success: function(data) {
                    $("#mytable").html(data);
                }
            });
        });
    });         
 
</script>
    -->
<!--<div class="pagination">
        <a href="#">&laquo;</a>
        <a href="#">1</a>
        <a href="#">2</a>
        <a class="active" href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">&raquo;</a>
    </div>-->


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

</body>

</html>