<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>

<body>
    <form action="" id="cusers" method="POST">
        <label for="username"">User Name </label>
            <input type=" text" name="username" id="username">
            <br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <br><br><br>

            <div class="check">

            </div>




            <input type="submit" value="Submit" name="submuit">








    </form>
    <br><br><br><br>

    <div class="action">
        <button onclick="active()">Active User </button>
        <button onclick="inactive()">Inactive User </button>
    </div>

    <div class="table">






    </div>






</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        active();
    });

    function active() {
        $.ajax({
            url: "../../admin/getdata/gettabledata.php",
            type: "POST",
            dataType: "json",
            data: {
                action: "active"
            },
            success: function(data) {
                var table = '<table border="1">';
                table += '<tr>';
                table += '<th>Username</th>';
                table += '<th>Password</th>'; // Assuming this is intentional for display
                table += '<th>Actions</th>';
                table += '</tr>';
                for (var i = 0; i < data.length; i++) {
                    table += '<tr>';
                    table += '<td>' + data[i].user_name + '</td>';

                    table += '<td><button class="edit-user-btn" data-eid="' + data[i].admin_id + '">Change Password</button></td>';
                    table += '<td><button onclick="deleteuser(' + data[i].admin_id + ')">Inactive User</button></td>';


                    table += '</tr>';
                }
                table += '</table>';
                $(".table").html(table);
            }
        });
    }

    function inactive() {
        $.ajax({
            url: "../../admin/getdata/gettabledata.php",
            type: "POST",
            dataType: "json",
            data: {
                action: "inactive"
            },
            success: function(data) {
                var table = '<table border="1">';
                table += '<tr>';
                table += '<th>Username</th>';
                table += '<th>Action</th>';
                table += '</tr>';
                for (var i = 0; i < data.length; i++) {
                    table += '<tr>';
                    table += '<td>' + data[i].user_name + '</td>';
                    table += '<td><button class="active-user-btn" data-eid="' + data[i].admin_id + '">Active User</button></td>';

                    table += '</tr>';
                }
                table += '</table>';
                $(".table").html(table);
            }
        });
    }

    $(document).ready(function() {
        $.ajax({
            url: "../../admin/getdata/getcheckbox.php",
            type: "POST",
            dataType: "json",
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    var id = data[i].area_id;
                    var name = data[i].area_name;
                    $(".check").append('<input type="checkbox" id="' + id + '" name="myCheckbox[]" value="' + id + '"><label for="' + id + '">' + name + '</label><br>');
                }
            }
        });
    });

    $("#cusers").submit(function(e) {
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        var data = $("#cusers").serialize();
        $.ajax({
            url: "../../admin/insertdata/insertuser.php",
            type: "POST",
            data: data,
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: 'User added successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            },

            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'There was an error adding the user',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $(document).on('click', '.edit-user-btn', function() {
            var userId = $(this).data('eid');
            chengepw(userId);
        });
        $(document).on('click', '.delete-user-btn', function() {
            var userId = $(this).data('eid');
            console.log(userId);
            deleteuser(userId);
        });

    });


    function chengepw(id) {
        Swal.fire({
            title: 'Enter new password',
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off',
                required: 'required'
            },
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: (password) => {
                $.ajax({
                    url: "../../admin/update.php",
                    type: "POST",
                    data: {
                        id: id,
                        password: password,
                        action: "changePassword"
                    },
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            title: 'Success!',
                            text: 'Password changed successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        active();
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error changing the password',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    }

    function deleteuser(id) {

        Swal.fire({
            title: 'Are you sure you want to delete this user?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                $.ajax({
                    url: "../../admin/update.php",
                    type: "POST",
                    data: {
                        id: id,
                        action: "deleteUser"
                    },
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            title: 'Success!',
                            text: 'User deleted successfully',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        active();
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error deleting the user',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    }
</script>



<script>
    $(document).on('click', '.active-user-btn', function() {
        var userId = $(this).data('eid');

        Swal.fire({
            title: 'Are you sure you want to activate this user?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.ajax({
                    url: "../../admin/update.php",
                    type: "POST",
                    data: {
                        id: userId,
                        action: "activeuser"
                    },
                    dataType: "json" // Ensure you expect a JSON response
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                if (result.value.status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: 'User activated successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'

                    });
                    inactive();
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: result.value.message || 'There was an error activating the user',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });
</script>


</html>