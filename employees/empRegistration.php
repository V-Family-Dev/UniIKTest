<?php

require "../include/head.php";




?>





<body>
    <h1>Employee Registration</h1>


    <form id="employeeadd" method="POST">
        <label for="firstName">First Name:</label>
        <input type="text" id="first_name" name="first_name" value=""><br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value=""><br>

        <label for="nic">NIC:</label>
        <input type="text" id="nic" name="nic" value=""><br>

        <label for="employeeNumber">Employee Number:</label>
        <input type="text" id="employee_no" name="employee_no" value="" readonly><br>

        <label for="reference_id">Ref Number:</label>
        <select id="reference_id" name="reference_id">
            <option value="">select Reference Id</option>

        </select>




        <br> <label for="primaryNumber">Primary Number</label>
        <input type="text" id="phone_no" name="phone_no" value=""><br>

        <label for="whatsapp_no">whastapp Number</label>
        <input type="text" id="whatsapp_no" name="whatsapp_no" value=""><br>

        <label for="address">Address</label>
        <textarea id="Address" name="Address" rows="4" cols="50"></textarea><br><br>

        <label for="province">Province</label>
        <select id="province" id="province" name="province">
            <option value="">Select a province</option>
            <?php foreach ($provinces as $province) : ?>
                <option value="<?= htmlspecialchars($province['id']); ?>">
                    <?= htmlspecialchars($province['name_en']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <!--districts-->
        <label for="districts">Districts</label>
        <select name="districts" id="districtsdata">
            <option value="">Select a districts</option>

        </select>

        <!-- City Selection -->
        <label for="city">City</label>
        <select name="city" id="citydata">
            <option value="">Select a city</option>
        </select>

        <!-- Postal Code Display -->
        <label for="postalCode">Postal Code</label>
        <input type="text" name="postalCode" id="postalCode" readonly><br><br>




        <p>bank details</p>

        <label for="bankSelect">Bank:</label>
        <select id="bankSelect" name="bankName">
            <option value="">Select Bank</option>

        </select><br>

        <label for="branchselect">Branch Name</label>
        <select id="branchselect" name="branchName">
            <option value="">Select Bank</option>

        </select><br>

        <br><label for="branchCode">Branch Code:</label>
        <input type="text" id="branchCode" name="branchCode" value="" readonly><br>



        <label for="accountHolderName">Account Holder Name:</label>
        <input type="text" id="accountHolderName" name="accountHolderName" value=""><br>

        <label for="accountNumber">Account Number:</label>
        <input type="text" id="AccountNum" name="AccountNum" value=""><br>

        <button type="submit" name="submit" id="add_empw" value="Submit"> Add Employee</button>
    </form>







    <?php
    require "../include/script.php";
    ?>

    <script>
        $(document).ready(function() {
            $('#addempForm').submit(function(event) {

                var first_name = 'nimal';
                var last_name = 'perera';
                event.preventDefault();
                var formData = {
                    first_name: first_name,
                    last_name: last_name

                };
                console.log(formData);
                $.ajax({
                    url: 'insertData/inEmployee.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: "application/json",
                    success: function(response) {
                        console.log(response);

                    },
                    error: function(xhr, status, error) {
                        $("#error-message").text("An error occurred: " + error).show();
                        $("#success-message").hide();
                    }
                });

            });


        });
    </script>


    <script>
        $(document).ready(function() {
            $('#add_emps').click(function(event) {

                var first_name = 'nimal';
                var last_name = 'perera';
                event.preventDefault();
                var formData = {
                    first_name: first_name,
                    last_name: last_name

                };
                console.log(formData);
                $.ajax({
                    url: 'insertData/inEmployee.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: "application/json",
                    success: function(response) {
                        console.log(response);

                    },
                    error: function(xhr, status, error) {
                        $("#error-message").text("An error occurred: " + error).show();
                        $("#success-message").hide();
                    }
                });

            });


        });
    </script>
    <script>
        $(document).ready(function() {
            $("#employeeadd").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                console.log(formData);
                $.ajax({
                    url: "insertdata/inemployee.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Employee added successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });


                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error adding the Employee',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>


</body>