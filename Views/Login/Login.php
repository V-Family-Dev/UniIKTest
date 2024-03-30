<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="css/style.css">

  <title>Login-UNIKONESOLUTIONS</title>
</head>

<body>

  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2 logo-div">
          <img src="images/Logo.png" width="30%" alt="Image" class="img-fluid">
          <h2 class="logo-name"><strong>UNIKONESOLUTIONS</strong></h2>
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <h3><strong>Account Login</strong></h3>
              </div>
              <form id="loginsite" method="POST">
                <div class="form-group first">
                  <label for="username">Username</label>
                  <input name="login-username" id="login-username" type="text" class="form-control">
                </div>
                <div class="form-group last mb-4">
                  <label for="password">Password</label>
                  <input name="login-password" id="login-password" type="password" class="form-control">
                </div>
                <div class="d-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                    <input name="login-checkbox" id="login-checkbox" type="checkbox" checked="checked" />
                    <div class="control__indicator"></div>
                  </label>
                  <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                </div>
                <input type="submit" value="Log In" name="login" class="btn text-white btn-block">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>
<script>
  $(document).ready(function() {
    $("#loginsite").submit(function(event) {
      event.preventDefault();
      var formData = new FormData(this);
      console.log(formData);
      $.ajax({
        type: "POST",
        url: "../../employees/login/check.php",
        data: formData,
        processData: false,
        contentType: false,

        success: function(response) {
          console.log(response);
          console.log("Raw response:", response);
          if (typeof response === "string") {
            try {
              response = JSON.parse(response);
            } catch (e) {
              console.error("Error parsing JSON:", e);
              return;
            }
          }
          console.log("Success:", response.success);
          console.log("Status:", response.status);
          console.log("Location:", response.location);
          if (response.status == "error") {
            console.log("Error:", response.error);
          } else {
            if (response.location == 2) {
              window.location.href = "../../Views/index.php"; //add admin location
            } else if (response.location == 1) {
              window.location.href = "../../Views/index.php";

            } else {
              console.log("Error:", response.error);
            }
          }






        },
        error: function(xhr, status, error) {
          console.log(error);
        }
      });
    });
  });
</script>

</html>