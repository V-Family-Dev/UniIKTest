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
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>



                <tr>


                </tr>
            </tbody>
        </table>


    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
                        row.append('<td><button data-empid="' + employee.empid + '" onclick="edit(this)">Edit</button> <button data-empid="' + employee.empid + '" onclick="deletes(this)">Delete</button></td>');
                        row.append('<td><button class="cpassword" data-empid="' + employee['Employee No'] + '">Password</button></td>');


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

<script>
    $(document).ready(function() {
        $(document).on('click', '.cpassword', function() {
            var empid = $(this).data('empid');

            Swal.fire({
                title: 'Do you want to change the password?',
                text: "This action cannot be undone",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve, reject) => {
                        $.ajax({
                            url: '../../employees/insertdata/emppassword.php',
                            type: 'POST',
                            data: {
                                empid: empid,
                                action: "emppassword"
                            },
                            dataType: 'json'
                        }).done((response) => {
                            if (response.status === 'success') {
                                resolve(response);
                            } else {
                                reject(response);
                            }
                        }).fail((jqXHR, textStatus, errorThrown) => {
                            Swal.showValidationMessage(`Request failed: ${textStatus}`);
                            reject(jqXHR);
                        });
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Changed!',
                        'The password has been changed.',
                        'success'
                    );
                }
            }).catch((error) => {
                Swal.fire('Error!', error.responseText || 'An unknown error occurred', 'error');
            });
        });
    });
</script>







</html>