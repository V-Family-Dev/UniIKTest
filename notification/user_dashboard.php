<?php
include '../Views/admin2/include/head.php';

//$empid = $_SESSION['emp_id'];
$empid = 'USD0013';
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>User Dashboard - UNIKONE SOLUTION</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500&display=swap">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/media-queries.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
	<link rel="stylesheet" href="assets/css/mycss.css">
	<style>
		#notificationMessages {
			display: none;
			position: fixed;
			/* Changed from absolute to fixed for consistent positioning */
			right: 10px;
			top: 50px;
			background-color: white;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
			padding: 15px;
			/* Slightly increased padding for better spacing */
			border-radius: 10px;
			/* Increased border radius for a softer look */
			width: 300px;
			z-index: 1000;
			/* Ensure it's on top of other elements */
			overflow-y: auto;
			/* Allows scrolling if many messages */
			max-height: 400px;
			/* Max height before scrolling */
		}

		#notificationMessages p {
			font-size: 14px;
			/* Adjust font size as needed */
			color: #333;
			/* Darker text for better readability */
			border-bottom: 1px solid #ddd;
			/* Separator between messages */
			padding-bottom: 10px;
			margin-bottom: 10px;
		}

		#notificationMessages p:last-child {
			border-bottom: none;
			margin-bottom: 0;
			padding-bottom: 0;
		}
	</style>

</head>

<body>
	<div class="wrapper">
		<div class="overlay"></div>
		<div class="content">

			<nav id="naviBar" class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
				<div class="container-fluid">
					<span class="comName">Dashboard</span>
					<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
						<span class="fas fa-user"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarCollapse">
						<ul class="navbar-nav ml-auto">
							<li class="naviIcon">
							</li>
							<li class="naviIcon">
								<i class="fa fa-calendar fa-lg mr-2" style="font-size: 18px;"></i>
								<span id="currentDate" class="bd-highlight align-self-center"><?= date('Y - M - d') ?></span>
							</li>
							<!-- notification section -->
							<li class="naviIcon ml-3" style="font-size: 100%;">
								<a class="noUnderline mr-2 ml-2" href="#" onclick="showNotifications()">
									<i class="fa fa-bell" style="font-size: 23px;" id="notificationIcon"></i>
									<span id="howmany" class="badge rounded-pill badge-notification bg-danger">10</span>
								</a>
								<div id="notificationMessages" style="display: none; position: absolute; right: 10px; top: 50px; background-color: rgb(238, 237, 237); box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); padding: 10px; border-radius: 5px; width: 300px;color: black;">
									<p>Message 1</p>
									<p>Message 2</p>
									<p>Message 3</p><!-- Notification content here -->
								</div>
							</li>
							<li class="naviIcon ml-2">
								<div class="mr-2 ml-2">
									<div>
										<span style="font-size: 15px;">Marley Botosh</span>
									</div>
									<div class="d-flex justify-content-center">
										<span style="font-size: 11px;">User</span>
									</div>
								</div>
							</li>
							<li class="dropdown naviIcon ml-2">
								<a class="noUnderline dropdown-toggle d-flex align-items-center ml-2" href="#" id="navbarDropdownProfile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-user-circle" style="font-size: 23px;"></i>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
										<a class="dropdown-item" href="#">Logout</a>
										<a class="dropdown-item" href="#">Your Info</a>
									</div>
							</li>
						</ul>
					</div>
				</div>
			</nav>



			<div id="notificationMessages" style="display: none; position: absolute; right: 10px; top: 50px; background-color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); padding: 10px; border-radius: 5px; width: 300px;">
				<!-- Example messages, populate as needed -->
				<p>Message 1</p>
				<p>Message 2</p>
				<p>Message 3</p>
				<!-- ... -->
			</div>

			<div class="first-content">
				<div class="container-fluid">
					<div class="row pt-5 pl-3 pr-3">
						<div class="col backTheam cRound p-4">
							<p class="h1" style="color: black;">Dilrukshan Jayawardene</p>
							<input type="text" class="userLabel" Value="USC10300 Active" readonly></input>
						</div>
					</div>
				</div>
			</div>
			<!------------------------------------------------------------ First Content End ------------------------------------------------------------>

			<!------------------------------------------------------------ Second Section Start ------------------------------------------------------------>
			<div class="container-fluid">
				<div class="row justify-content-center pt-4">
					<div class="col-md-3 pt-3 cRound mt-3" style="background-color: rgb(241, 241, 241);">
						<div class="cRound p-3" style="background-color: rgb(241, 220, 183);">
							<div class="div">
								<h1 style="font-weight: 700;">LKR</h1>
							</div>
							<div class="div">
								<h3 style="font-weight: 700;">10,000,000.00</h3>
							</div>
						</div>
						<div>
							<h5>Total<br>Earnings</h5>
						</div>
					</div>
					<div class="col-md-3 pt-3 cRound  mt-3" style="background-color: rgb(241, 241, 241);">
						<div class="cRound p-3" style="background-color: #c0ec9f;">
							<div class="div">
								<h1 style="font-weight: 700;">LKR</h1>
							</div>
							<div class="div">
								<h3 style="font-weight: 700;">10,000,000.00</h3>
							</div>
						</div>
						<div>
							<h5>Total Paid<br>Earnings</h5>
						</div>
					</div>
					<div class="col-md-3 pt-3 cRound  mt-3" style="background-color: rgb(241, 241, 241);">
						<div class="cRound p-3" style="background-color: rgba(245, 165, 165, 0.8);">
							<div class="div">
								<h1 style="font-weight: 700;">LKR</h1>
							</div>
							<div class="div">
								<h3 style="font-weight: 700;">10,000,000.00</h3>
							</div>
						</div>
						<div>
							<h5>Pending<br>Payments</h5>
						</div>
					</div>
				</div>
			</div>
			<!------------------------------------------------------------ Second Section End ------------------------------------------------------------>
			<!------------------------------------------------------------ Third Section Start ------------------------------------------------------------>
			<div class="container-fluid">
				<div class="row justify-content-center pt-4">
					<div class="col-md-5 pt-3 cRound" style="background-color: rgb(241, 241, 241);">
						<div>
							<div class="div">
								<h3 style="font-weight: 700;">Sale Code & Items</h3>
							</div>
						</div>
						<input class="btnInit btnCream2" type="submit" id="show" name="show" value="Show">
					</div>
				</div>
			</div>
			<!------------------------------------------------------------ Third Section End ------------------------------------------------------------>
			<!------------------------------------------------------------ Forth Section Start ------------------------------------------------------------>
			<div class="container-fluid">
				<div class="row justify-content-center p-3">
					<div class="col pt-3 cRound" style="background-color: rgb(241, 241, 241);">
						<table id="showTable" class="table table-hover backTheam">
							<thead>
								<tr style="background-color: #b4b3b3">
									<th scope="col">Items</th>
									<th scope="col">Sale Code</th>
									<th scope="col">Commision</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Dilrukshan Jayawardane</td>
									<td>USD10300</td>
									<td>EM,CM,SM</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!------------------------------------------------------------ Forth Section End ------------------------------------------------------------>

		</div>
	</div>


	<?php include 'include/scriptlink.php'; ?>
	<script>
		// Function to show or hide the notification messages
		function showNotifications() {
			$('#notificationMessages').toggle();
		}

		$(document).ready(function() {
			// Fetch notifications from the server
			function fetchNotifications() {
				let empid = '<?= $empid ?>'; // Make sure this PHP variable is set

				$.ajax({
					url: '../../notification/get.php',
					type: 'POST',
					data: {
						empid: empid,
						action: "getNotification"
					},
					success: function(response) {
						let data = JSON.parse(response);
						$('#howmany').text(data.howmany);
						let messagesContainer = $('#notificationMessages');
						messagesContainer.empty();
						if (data.notifications) {
							data.notifications.forEach(function(notification) {
								messagesContainer.append($('<p>').text(notification.message));
							});
						}
					},
					error: function(xhr, status, error) {
						console.error("Error fetching notifications:", xhr.status, error);
					}
				});
			}

			// Set up the click event for the notification icon
			$('#notificationIcon').click(function(e) {
				e.preventDefault(); // Prevent the default anchor action
				showNotifications();
				fetchNotifications(); // Fetch notifications when the icon is clicked
			});
		});
	</script>




</body>

</html>