<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

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
        <h1>Manage Employee</h1>

        <!-- Search bar -->
        <form id="search" method="post">
            <input type="text" placeholder="Employee Code">
            <button type="submit">Search</button>
        </form>
        <button id="inactive">inactive user </button>



        <!-- Table -->
        <table id="emp_s">


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
            if (emp_code == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please enter an employee code!',
                });
                return;
            }

            // Clear the table before making the AJAX request
            $('#emp_s thead').empty();
            $('#emp_s tbody').empty();

            $.ajax({
                url: '../../employees/getdata/getemptable.php',
                method: 'POST',
                data: {
                    emp_code: emp_code,
                    action: "search"
                },
                success: function(data) {

                    var table = $('#emp_s tbody');
                    var emp = JSON.parse(data);
                    var headerRow = $('<thead>');
                    headerRow.append('<tr>');
                    headerRow.append('<th>Name</th>');
                    headerRow.append('<th>NIC</th>');
                    headerRow.append('<th>Employee No</th>');
                    headerRow.append('<th>Mobile Number</th>');
                    headerRow.append('<th>City</th>');
                    headerRow.append('<th>District</th>');
                    headerRow.append('<th>Bank Name</th>');
                    headerRow.append('<th>Edit</th>');
                    headerRow.append('<th>Inactive</th>');

                    headerRow.append('<th>Password </th>');

                    headerRow.append('</tr>');
                    table.append(headerRow);

                    // Create table body
                    var tbody = $('<tbody>');

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
                        row.append('<td><button data-empid="' + employee.empid + '" onclick="edit(this)">Edit</button></td>');
                        row.append('<td><button class="dpassword" data-empid="' + employee['Employee No'] + '">Delete</button></td>');
                        row.append('<td><button class="cpassword" data-empid="' + employee['Employee No'] + '">Password</button></td>');

                        tbody.append(row);
                    });

                    // Append tbody to table
                    table.append(tbody);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("error", textStatus, errorThrown);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#inactive').click(function() {
            inactiveuser();
        });
    });

    function inactiveuser() {
        $.ajax({
            url: '../../employees/getdata/getemptable.php',
            method: 'POST',
            data: {
                action: 'inactive'
            },
            success: function(data) {
                var table = $('#emp_s tbody');
                var emp = JSON.parse(data);

                table.empty();

                var headerRow = $('<thead>');
                headerRow.append('<tr>');
                headerRow.append('<th>Name</th>');
                headerRow.append('<th>NIC</th>');
                headerRow.append('<th>Employee No</th>');
                headerRow.append('<th>Mobile Number</th>');
                headerRow.append('<th>City</th>');
                headerRow.append('<th>District</th>');
                headerRow.append('<th>Bank Name</th>');

                headerRow.append('<th>Active</th>');
                headerRow.append('<th>Delete</th>');

                headerRow.append('</tr>');
                table.append(headerRow);

                // Create table body
                var tbody = $('<tbody>');

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
                    row.append('<td><button class="activeuser" data-empid="' + employee['Employee No'] + '">Active</button></td>');
                    row.append('<td><button class="cdpassword" data-empid="' + employee['Employee No'] + '">Delete</button></td>');
                    tbody.append(row);
                });

                // Append tbody to table
                table.append(tbody);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("error", textStatus, errorThrown);
            }
        });
    }
</script>









<script>
    function edit(btn) {
        var empid = $(btn).data('empid');
        console.log(empid);
        window.location.href = 'edit_emp.php?empid=' + empid;


    }
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.activeuser', function(e) {
            e.preventDefault();
            var empid = $(this).data('empid');
            console.log(empid);

            // SweetAlert for activating employee
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to activate this employee.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, activate it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../../employees/getdata/getemptable.php', // URL to your API or server-side code
                        type: 'POST',
                        data: {
                            empid: empid,
                            action: "activate"

                        },
                        success: function(response) {
                            Swal.fire(
                                'Activated!',
                                'The employee has been activated.',
                                'success'
                            );
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was an issue activating the employee.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        $(document).on('click', '.cdpassword', function(e) {
            e.preventDefault();
            var empid = $(this).data('empid');
            console.log(empid);

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to permanently remove this user.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../../employees/getdata/getemptable.php',
                        type: 'POST',
                        data: {
                            empid: empid,
                            action: "delete"
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'The user has been removed.',
                                'success'
                            );
                            // Additional code to update your UI
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was an issue removing the user.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
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

<script>
    $(document).ready(function() {
        $(document).on('click', '.dpassword', function(e) { // Include 'e' as a parameter here
            e.preventDefault(); // Now 'e' is defined
            var empid = $(this).data('empid');
            console.log(empid);
            deleteEmployee(empid); // Corrected function name
        });
    });

    function deleteEmployee(empid) {
        Swal.fire({
            title: 'Confirm Deletion',
            text: "Are you sure you want to delete this employee? This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return deleteEmployeeAjax(empid);
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Deleted!', 'The employee has been successfully deleted.', 'success');
            }
        }).catch((error) => {
            Swal.fire('Error!', error.responseText || 'An error occurred', 'error');
        });
    }

    function deleteEmployeeAjax(empid) {
        return new Promise((resolve, reject) => {
            $.ajax({
                    url: '../../employees/insertdata/emppassword.php',
                    type: 'POST',
                    data: {
                        empid: empid,
                        action: "deleteemp"
                    },
                    dataType: 'json'
                }).done((response) => {
                    console.log(response); // Check what response is being received
                    if (response.status === 'success') {
                        resolve(response);
                    } else {
                        reject(response);
                    }
                })
                .fail((jqXHR, textStatus) => {
                    console.log('Request failed: ', textStatus, jqXHR); // Log more details
                    Swal.showValidationMessage(`Request failed: ${textStatus}`);
                    reject(jqXHR);
                });
        });
    }
</script>







</html>