<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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

    <div class="table">
        <button onclick="active()">Active User </button>
        <button onclick="inactive()">Inactive User </button>





    </div>

    <tr><button onclick="chengepw()">Password change</button></tr>
    <tr><button onclick="deleteuser()">inactive user</button></tr>




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
                console.log(data);
                var table = '<table border="1">';
                table += '<tr>';
                table += '<th>Username</th>';
                table += '<th>Password</th>'; // Assuming this is intentional for display
                table += '<th>Actions</th>';
                table += '</tr>';
                for (var i = 0; i < data.length; i++) {
                    table += '<tr>';
                    table += '<td>' + data[i].user_name + '</td>';

                    table += '<td><button onclick="chengepw(' + data[i].id + ')">change password</button></td>';
                    table += '<td><button onclick="deleteuser(' + data[i].id + ')">Inactive User</button></td>';

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
                console.log(data);
                var table = '<table border="1">';
                table += '<tr>';
                table += '<th>Username</th>';
                table += '<th>Action</th>'; // Assuming this is intentional for display
                table += '</tr>';
                for (var i = 0; i < data.length; i++) {
                    table += '<tr>';
                    table += '<td>' + data[i].user_name + '</td>';
                    table += '</tr>';
                    table += '<td><button onclick="deleteuser(' + data[i].id + ')">Inactive User</button></td>';
                }
                table += '</table>';
                $(".table").html(table);
            }
        });
    }
</script>















<script>
    $(document).ready(function() {
        $.ajax({
            url: "../../admin/getdata/getcheckbox.php",
            type: "POST",
            dataType: "json", // Parses the returned data as JSON
            success: function(data) {
                console.log(data);
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
                // Assuming 'response' is a string or object that indicates success
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

</html>