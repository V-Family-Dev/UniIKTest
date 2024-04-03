<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>


<?php
require_once '../../DB/dbconfig.php';
if (isset($_GET['empid']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $idemp = $_GET['empid'];





?>

    <form id="empupdate" method="POST">

        <label for="firstName">First Name:</label>
        <input type="text" id="first_name" name="first_name" value=""><br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value=""><br>

        <label for="nic">NIC:</label>
        <input type="text" id="nic" name="nic" value=""><br>

        <label for="employeeNumber">Employee Number:</label>
        <input type="text" id="employee_no" name="employee_no" value="" readonly><br>

        <label for="reference_id">Ref Number:</label>
        <input type="text" id="reference_id" name="reference_id" value="" readonly><br>


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


            </option>
        </select><br>
        <!--emp id-->
        <input type="hidden" name="empsid" id="empsid" value="<?= $idemp ?>">

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

        </select><br><br>
        <br><label for="bankCode">Bank Code:</label>
        <input type="text" id="bankcode" name="bankcode" value="" readonly><br><br>

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
}

?>

<body>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<script>
    $(document).ready(function() {

        var id = "<?= $idemp ?>";
        $.ajax({
            url: "../../employees/getdata/getempdata.php",
            type: "POST",
            data: {
                empid: id,
                action: 'getempdata'
            },
            success: function(data) {
                //console.log(data);
                var emp = JSON.parse(data);
                //console.log(emp);
                $('#first_name').val(emp[0].f_Name);
                $('#last_name').val(emp[0].l_name);
                $('#nic').val(emp[0].NIC);
                $('#employee_no').val(emp[0]['Employee No']); // Handle space in key
                $('#phone_no').val(emp[0]['Mobile Number']); // Assuming you want to use Mobile Number
                $('#whatsapp_no').val(emp[0].whastapp);
                $('#Address').val(emp[0].Address);
                $('#AccountNum').val(emp[0].ac_no);
                $('#accountHolderName').val(emp[0].h_name);
                $('#branchCode').val(emp[0].branch_id);
                $('#postalCode').val(emp[0].postcode);
                $('#reference_id').val(emp[0].provinces_id);
                $('#bankcode').val(emp[0].Bank_Id);


                var provinceId = emp[0].provinces_id;
                var districtId = emp[0].district_id;
                var cityId = emp[0].postcode;
                var bankId = emp[0].Bank_Id;


                var branchId = emp[0].branch_id;
                getpro(provinceId, districtId, cityId, bankId, branchId, emp[0].postcode);
                getdis(districtId);
                getcity(cityId);
                getbank(bankId);
                getbranch(branchId);




            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error: ", textStatus, errorThrown);

            }
        });
    });

    function getpro(provinceId) {


        $.ajax({
            url: '../../employees/getdata/getempdata.php',
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'getpro'
            },
            success: function(pro) {
                //console.log(pro);

                var provinceSelect = $("#province");
                provinceSelect.empty();

                provinceSelect.append('<option value="">Select a province</option>');


                for (var i = 0; i < pro.length; i++) {

                    var province = pro[i];
                    (province.id == provinceId) ? selected = 'selected': selected = '';
                    var ops = '<option value="' + province.id + '" ' + selected + '>' + province.name_en + '</option>';
                    provinceSelect.append(ops);
                }



            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("error", textStatus, errorThrown);
            }

        });









    }

    function getdis(districtId) {
        //console.log(districtId);
        $.ajax({
            url: '../../employees/getdata/getempdata.php',
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'getdis'
            },
            success: function(pro) {
                //console.log(pro);

                var districtSelect = $("#districtsdata");
                districtSelect.empty();
                districtSelect.append('<option value="">Select a District</option>');

                for (var i = 0; i < pro.length; i++) {
                    var district = pro[i];
                    var selected = (district.id == districtId) ? 'selected' : ''; // Select the current district
                    var ops = '<option value="' + district.id + '" ' + selected + '>' + district.name_en + '</option>';
                    districtSelect.append(ops);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("error", textStatus, errorThrown);
            }
        });
    }

    function getcity(cityid) {
        //console.log(cityid);
        $.ajax({
            url: '../../employees/getdata/getempdata.php',
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'getcity'
            },
            success: function(pro) {
                //console.log(pro);
                var citySelect = $("#citydata");
                citySelect.empty();
                citySelect.append('<option value="">Select a City</option>');

                for (var i = 0; i < pro.length; i++) {
                    var city = pro[i];
                    var selected = (city.postcode == cityid) ? 'selected' : ''; // Select the current district
                    var ops = '<option value="' + city.postcode + '" ' + selected + ' data-postalcode="' + city.postcode + '">' + city.name_en + '</option>';
                    citySelect.append(ops);
                }




            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("error", textStatus, errorThrown);
            }
        });
    }

    function getbank(bankId) {

        $.ajax({
            url: '../../employees/getdata/getempdata.php',
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'getbank'
            },
            success: function(pro) {
                //console.log(pro);
                var bankSelect = $("#bankSelect");
                bankSelect.empty();
                bankSelect.append('<option value="">Select a Bank</option>');

                pro.forEach(function(bank) {
                    var selected = (bank.ID == bankId) ? 'selected' : ''; // Select the current district
                    //console.log(selected);
                    var ops = '<option value="' + bank.ID + '" ' + selected + ' data-bank="' + bank.ID + '">' + bank.name + '</option>';
                    bankSelect.append(ops);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("error", textStatus, errorThrown);
            }
        });
    }


    function getbranch(branchId) {

        $.ajax({
            url: '../../employees/getdata/getempdata.php',
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'getbranch'
            },
            success: function(pro) {
                //console.log(pro);
                var branchSelect = $("#branchselect");
                branchSelect.empty();
                branchSelect.append('<option value="">Select a Branch</option>');
                for (var i = 0; i < pro.length; i++) {
                    var branch = pro[i];
                    //console.log();

                    // Ensure this matches your data
                    var selected = (branch.branchID == branchId) ? 'selected' : ''; // Select the current district
                    var ops = '<option value="' + branch.branchID + '" ' + selected + '>' + branch.branchName + '</option>';
                    branchSelect.append(ops);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("error", textStatus, errorThrown);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('#empupdate').submit(function(e) {
            e.preventDefault();
            var empdata = $(this).serializeArray(); // Use serializeArray to get form data as key-value pairs
            $.ajax({
                url: '../../employees/update.php',
                method: 'POST',
                data: empdata, // Directly use the array here
                success: function(data) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Employee Update successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
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

<script>
    $(document).ready(function() {
        $('#province').select2();
        $('#districtsdata').select2();
        $('#citydata').select2();
        $('#bankSelect').select2();
        $('#branchselect').select2();
    });
</script>

<script>
    $("#province").change(function() {
        var provinceId = $("#province").val();
        ////console.log(provinceId);

        $.ajax({
            url: '../../employees/getdata/getDistricts.php',
            method: 'POST',
            dataType: 'json',
            data: {
                provinceId: provinceId
            },
            success: function(data) {
                ////console.log(data);

                var citySelect = $("#districtsdata");
                citySelect.empty();

                citySelect.append('<option value="">Select a City</option>');

                for (var i = 0; i < data.length; i++) {
                    var city = data[i];
                    var ops = '<option value="' + city.id + '">' + city.name_en + '</option>';
                    citySelect.append(ops);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("error", textStatus, errorThrown);
            }
        });
    });
    $("#districtsdata").change(function() {
        var districtId = $("#districtsdata").val();
        ////console.log(districtId);

        $.ajax({
            url: '../../employees/getdata/getCity.php',
            method: 'POST',
            dataType: 'json',
            data: {
                districtId: districtId
            },
            success: function(data) {
                ////console.log(data);

                var citySelect = $("#citydata");
                citySelect.empty();

                citySelect.append('<option value="">Select a City</option>');

                for (var i = 0; i < data.length; i++) {
                    var city = data[i];
                    var ops = '<option value="' + city.id + '" data-postalcode="' + city.postcode + '">' + city.name_en + '</option>';
                    citySelect.append(ops);

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("error", textStatus, errorThrown);
            }
        });


    });
    $("#citydata").change(function() {
        var postalCode = $("#citydata").val(); // Get the value of the selected option
        $("#postalCode").val(postalCode);
        ////console.log(postalCode);
    });
</script>
<script>
    $("#bankSelect").change(function() {
        var selectedOption = $("#bankSelect option:selected");
        var bankId = selectedOption.data('bank');
        $("#bankcode").val(bankId);
        $.ajax({
            url: '../../employees/getdata/getBranch.php',
            method: 'POST',
            dataType: 'json',
            data: {
                bankID: bankId
            },
            success: function(data) {
                ////console.log(data);

                var branchSelect = $("#branchselect");
                branchSelect.empty();

                branchSelect.append('<option value="">Select a Branch</option>');

                for (var i = 0; i < data.length; i++) {
                    var branch = data[i];
                    var ops = '<option value="' + branch.id + '" data-bankid="' + branch.id + '">' + branch.name + '</option>';
                    branchSelect.append(ops);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("error", textStatus, errorThrown);
            }
        });
        $("#branchselect").change(function() {
            var branchCode = $("#branchselect option:selected").val();
            $("#branchCode").val(branchCode);
        });


    });
</script>
















</html>