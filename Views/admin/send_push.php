<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
    <form id="sendpush" action="test.php" method="POST">


        <label for="phone">Phone Numbers</label>
        <textarea name="phone" id="phone"></textarea>
        <br><br>
        <label for="massageid">Select Message</label>
        <select name="massageid" id="massageid">
            <option value="">Select Message</option>

        </select>
        <br><br><br>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <br><br>
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="30" rows="10"></textarea>
        <br><br>
        <input type="submit" name="sendsmss" id="sendsmss" value="Send SMS">
    </form>




    <hr>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <tr>

            </tr>
        </tbody>
    </table>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $('#sendpush').submit(function(e) {
            e.preventDefault();
            var phone = $('#phone').val();
            var messageid = $('#massageid').val();
            var title = $('#title').val();
            var message = $('#message').val();
            var type = $('#type').val();
            $.ajax({
                url: '../../admin/sendmsg/pushcontroler.php',
                type: 'POST',
                data: {
                    phone: phone,
                    messageid: messageid,
                    title: title,
                    message: message,
                    type: type,
                    action: 'sendpush'
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#phone').change(function() {
                var input = $('#phone').val();
                const myArray = input.split(" ");
                var formattedNumbers = myArray;
                $('#phone').val(formattedNumbers);

            });
        });




        // get select data
        $(document).ready(function() {
            $.ajax({
                url: '../../admin/sendmsg/msgcontroler.php',
                type: 'POST',
                data: {
                    action: 'getmsg'
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var option = '';
                    for (var i = 0; i < data.length; i++) {
                        option += '<option value="' + data[i].mid + '">' + data[i].title + '</option>';

                    }
                    $('#massageid').append(option);
                }


            });
        });

        $(document).on('change', '#massageid', function() {
            var mid = $(this).val();
            console.log(mid);
            if (mid != 1) {
                $.ajax({
                    url: '../../admin/sendmsg/msgcontroler.php',
                    type: 'POST',
                    data: {
                        action: 'getmsgdata',
                        mid: mid
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $('#title').val(data[0].title);
                        $('#message').val(data[0].messenge);
                        $('#sendsmss').find('input[type="submit"]').prop('disabled', false);

                    }
                });
            } else {
                $('#title').val('');
                $('#message').val('');
            }

        });
    </script>







</html>