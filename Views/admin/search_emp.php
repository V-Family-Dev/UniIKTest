<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <style>
        .table-container {
            padding: 20px;
            background-color: #f5f5f5;
            /* Change as per your color scheme */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            /* Light grey border for rows */
        }

        th {
            background-color: #f0f0f0;
            /* Slightly darker bg for headers */
        }
    </style>
</head>

<body>

    <div class="table-container">
        <!-- Title -->
        <h1>Manage Users</h1>

        <!-- Search bar -->
        <form id="search" method="post">
            <input type="text" placeholder="Employee Code">
            <button type="submit">Search</button>
        </form>



        <!-- Table -->
        <table id="emp_s">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>NIC</th>
                    <th>Employee No</th>
                    <th>Mobile Number</th>
                    <th>City</th>
                    <th>District</th>
                    <th>Bank Name</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <!-- <td>John Doe</td>
                    <td>123456789V</td>
                    <td>EMP001</td>
                    <td>0712345678</td>
                    <td>Colombo</td>
                    <td>Western</td>
                    <td>Bank of Ceylon</td>
                    <td>
                        <button>Edit</button>
                        <button>Delete</button>
                    </td> -->
                <td><button data-empid="" onclick="edit(this)">Edit</button></a> <button onclick="deletes(this)">Delete</button></td>

                <tr>


                </tr>
            </tbody>
        </table>


    </div>

</body>

<script>
    $(document).ready(function() {


        console.log("Page loaded!");
    });
</script>

<script>
    $(document).ready(function() {
        $('#search').submit(function(e) {
            e.preventDefault();
            var emp_code = $(this).find('input').val();

            // Clear the table before making the AJAX request
            $('#emp_s tbody').empty();

            $.ajax({
                url: '../../employees/getdata/getemptable.php',
                method: 'POST',
                data: {
                    emp_code: emp_code
                },
                success: function(data) {
                    console.log(data);
                    var table = $('#emp_s tbody');
                    var emp = JSON.parse(data);

                    // Use forEach to iterate over the emp array
                    emp.forEach(function(employee) {
                        var row = $('<tr>');
                        row.append('<td>' + employee.Name + '</td>');
                        row.append('<td>' + employee.NIC + '</td>');
                        row.append('<td>' + employee['Employee No'] + '</td>');
                        row.append('<td>' + employee['Mobile Number'] + '</td>');
                        row.append('<td>' + employee.City + '</td>');
                        row.append('<td>' + employee.District + '</td>');
                        row.append('<td>' + employee['Bank Name'] + '</td>');
                        row.append('<td><button data-empid="' + employee['empid'] + '" onclick="edit(this)">Edit</button></a> <button data-empid="' + employee['empid'] + '"onclick="deletes(this)">Delete</button></td>');

                        table.append(row);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("error", textStatus, errorThrown);
                }
            });
        });
    });
</script>









<script>
    function edit(btn) {
        var empid = $(btn).data('empid');
        console.log(empid);
        window.location.href = 'edit_emp.php?empid=' + empid;


    }

    function deletes(btn) {
        var empid = $(btn).data('empid');
        console.log(empid);

    }
</script>

</html>