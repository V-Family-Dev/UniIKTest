<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/loginStyle.css">

  <title>Login</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-around mt-4">
      <div class="backPlate">
        <div>
          <div class="row">

            <div class="col-md-6 order-md-2 d-flex align-items-center justify-content-center">
              <div class="contentImg">
                <img src="assets/img/Logo.png" width="40%" alt="Image" class="img-fluid">
                <h2 class="logoName"><strong>UNIKONE SOLUTIONS</strong></h2>
              </div>
            </div>

            <div class="col-md-6 p-4">
              <div class="row justify-content-center">
                <div>
                  <div class="mb-4 text-center">
                    <h3><strong>Account Login</strong></h3>
                  </div>
                  <form id="loginsite" method="POST">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                      <label class="form-label mb-0" for="form1Example13" style="font-size: 14px;">Email address</label>
                      <input type="email" id="form1Example13" class="form-control form-control-lg" style="border-radius: 30px;" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <label class="form-label mb-0" for="form1Example23" style="font-size: 14px;">Password</label>
                      <input type="password" id="form1Example23" class="form-control form-control-lg" style="border-radius: 30px;" />
                    </div>

                    <div class="d-flex justify-content-start align-items-center mb-4">
                      <!-- Checkbox -->
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                        <label class="form-check-label" for="form1Example3"> Remember me </label>
                      </div>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</body>
<?php
require "include/scriptlink.php";
?>

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

          // Parse the response as JSON if it's a string
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

          // Check if the response indicates an error
          if (response.status == "error") {
            console.log("Error:", response.error);
          } else {
            // Redirect based on the location provided in the response
            if (response.location == 2) {
              window.location.href = "../../admin/index.php"; // Redirect to admin page
            } else if (response.location == 1) {
              window.location.href = "../../employees/index.php"; // Redirect to employee page
            } else {
              console.error("Invalid location:", response.location);
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