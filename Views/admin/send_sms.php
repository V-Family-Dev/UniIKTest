<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
    <form id="sendsms" action="test.php" method="POST">
        <input type="radio" name="type" value="Phone" id="option1">
        <label for="option1">Phone No</label><br>

        <input type="radio" name="type" value="id" id="option2">
        <label for="option2">Emp id</label><br><br>

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
        <input type="submit" name="sendsmss" id="sendsmss" value="Send SMS" disabled>
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

        // get message data after select
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
                        $('#sendsms').find('input[type="submit"]').prop('disabled', false);

                    }
                });
            } else {
                $('#title').val('');
                $('#message').val('');
                $('#sendsms').find('input[type="submit"]').prop('disabled', false);
            }

        });
        //show all msg in table
        $(document).ready(function() {
            $.ajax({
                url: '../../admin/sendmsg/msgcontroler.php',
                type: 'POST',
                data: {
                    action: 'getallmsg'
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    var tr = '';
                    for (var i = 0; i < data.length; i++) {
                        tr += '<tr>';
                        tr += '<td>' + data[i].title + '</td>';
                        tr += '<td>' + data[i].messenge + '</td>';
                        tr += '</tr>';
                    }
                    $('tbody').html(tr);
                }




            });
        });



        $(document).ready(function() {
            $('#sendsms').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('action', 'sendsmss');

                // Debug: Log FormData content
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }

                $.ajax({
                    url: '../../admin/sendmsg/msgcontroler.php', // Ensure this path is correct
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        try {
                            var data = JSON.parse(response);
                            Swal.fire({
                                icon: data.status === 'success' ? 'success' : 'error',
                                title: data.status === 'success' ? 'Success' : 'Error',
                                text: data.message,
                            });
                        } catch (e) {
                            console.error("Error parsing JSON:", e);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Invalid response from the server',
                            });
                        }
                    },
                    error: function(xhr, status, errorThrown) {
                        console.error("AJAX Error:", xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'There was an error processing your request.',
                        });
                    }
                });
            });
        });
    </script>



</html>