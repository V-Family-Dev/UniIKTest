<?php
require_once "../include/auth.php";
?>


<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Items - UNIKONE SOLUTION</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500&display=swap">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/media-queries.css">

	<link rel="stylesheet" href="assets/css/mycss.css">
	https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css

</head>

<body>

	<!-- Wrapper -->
	<div class="wrapper">

		<!-- Sidebar -->
		<nav class="sidebar">

			<!-- close sidebar menu -->

			<div class="m-1">
				<h3></h3>
			</div>

			<ul class="list-unstyled menu-elements">
				<li class="">
					<h4 class="ml-4">Menu</h4>
					<div class="dismiss">
						<i class="fas fa-times"></i>
					</div>

				</li>
				<li>
					<a href="#EM" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="EM">
						<i class="fas fa-user-plus"></i>Employee Master
					</a>
					<ul class="collapse list-unstyled" id="EM">
						<li>
							<a href="Create Employee.html">Create Employee</a>
						</li>
						<li>
							<a href="Search Employee.html">Search Employee</a>
						</li>
						<li>
							<a href="Manage Employee.html">Manage Employee</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#CM" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="CM">
						<i class="fas fa-calculator"></i>Item Master
					</a>
					<ul class="collapse list-unstyled" id="CM">
						<li>
							<a href="Items.html">Items</a>
						</li>
						<li>
							<a href="Payments.html">Payments</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#SM" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="SM">
						<i class="fas fa-receipt"></i>Sales Management
					</a>
					<ul class="collapse list-unstyled" id="SM">
						<li>
							<a href="Create Sale Order.html">Create Sale Order</a>
						</li>
						<li>
							<a href="Search Sale Orders.html">Search Sale Orders</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#rPort" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="rPort">
						<i class="fas fa-file"></i>Reports
					</a>
					<ul class="collapse list-unstyled" id="rPort">
						<li>
							<a href="Create Sale Order.html">Create Sale Order</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#sendSMS" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="sendSMS">
						<i class="fas fa-user"></i>Send SMS
					</a>
					<ul class="collapse list-unstyled" id="sendSMS">
						<li>
							<a href="SMS by UserID.html">SMS by UserID</a>
						</li>
						<li>
							<a href="SMS by Mobile No.html">SMS by Mobile No.</a>
						</li>
						<li>
							<a href="Push Notification.html">Push Notification</a>
						</li>
					</ul>
				</li>
			</ul>

		</nav>
		<!-- End sidebar -->

		<!-- Dark overlay -->
		<div class="overlay"></div>

		<!-- Content -->
		<div class="content">

			<nav id="naviBar" class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
				<div class="container-fluid">
					<i class="fas fa-angle-double-right fa-sm mr-3 text-light open-menu" style="cursor:pointer;"></i>
					<span class="comName">Dashboard</span>
					<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
						<span class="fas fa-user"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarCollapse">
						<ul class="navbar-nav ml-auto">
							<li class="naviIcon">
							</li>
							<li class="naviIcon">
								<i class="bi bi-calendar fa-lg mr-2" style="font-size: 18px;"></i>
								<span id="currentDate" class="bd-highlight align-self-center">[Current date]</span>
							</li>
							<li class="naviIcon ml-2">
								<div class="mr-2 ml-2">
									<div>
										<span style="font-size: 15px;">Marley Botosh</span>
									</div>
									<div class="d-flex justify-content-center">
										<span style="font-size: 11px;">Administrator</span>
									</div>
								</div>
							</li>
							<li class="dropdown naviIcon ml-2">
								<a class="noUnderline dropdown-toggle d-flex align-items-center ml-2" href="#" id="navbarDropdownProfile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-user-circle" style="font-size: 23px;"></i>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
										<a class="dropdown-item" href="#">Logout</a>
									</div>
							</li>
						</ul>
					</div>
				</div>
			</nav>


			<!------------------------------------------------------------ First Content Start ------------------------------------------------------------>
			<div class="first-content">
				<div class="container-fluid">
					<div class="row pt-5 pl-3 pr-3">
						<h5 class="mb-1 ml-2">Items</h5>

						<form id="itemCreationForm" action="itemConfig.php" method="POST">
							<div class="col-12 backTheam cRound p-4">
								<div class="row">
									<div class="col-2">
										<label for="itemCode" class="form-label">Item Code</label>
										<input class="inputBox" id="itemCode" name="itemCode" type="text" placeholder="Item Code">
									</div>
									<div class="col-2">
										<label for="commiName" class="form-label">Item Name</label>
										<input class="inputBox" id="itemName" name="itemName" type="text" placeholder="Item Name">
									</div>
									<div class="col-2">
										<label for="price" class="form-label">Price</label>
										<input class="inputBox" id="price" name="price" type="text" placeholder="Price Amount">
									</div>
									<div class="col-1">
										<label for="level1" class="form-label">LV 01</label>
										<input class="inputBox" id="price" name="level_1" type="text" placeholder="Value">
									</div>
									<div class="col-1">
										<label for="level2" class="form-label">LV 02</label>
										<input class="inputBox" id="price" name="level_2" type="text" placeholder="Value">
									</div>
									<div class="col-1">
										<label for="level3" class="form-label">LV 03</label>
										<input class="inputBox" id="price" name="level_3" type="text" placeholder="Value">
									</div>
									<div class="col-1">
										<label for="level4" class="form-label">LV 04</label>
										<input class="inputBox" id="price" name="level_4" type="text" placeholder="Value">
									</div>
									<div class="col-1">
										<label for="level5" class="form-label">LV 05</label>
										<input class="inputBox" id="price" name="level_5" type="text" placeholder="Value">
									</div>
									<div class="col-1">
										<label for="level6" class="form-label">LV 06</label>
										<input class="inputBox" id="price" name="level_6" type="text" placeholder="Value">
									</div>
								</div>


								<div class="col mt-4 d-flex justify-content-start">
									<div class="row">
										<input class="btnInit btnGreen text-light" type="submit" id="createBtn" name="Create" value="Create">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<script>
				$(document).ready(function() {
					$("#itemCreationForm").submit(function(e) {
						e.preventDefault();
						var formData = new FormData(this);
						$.ajax({
							url: "../item/itemConfig.php",
							type: "POST",
							data: formData,
							contentType: false,
							processData: false,
							success: function(data) {
								try {
									if (data.status === "success") {
										Swal.fire({
											title: 'Success!',
											text: data.message,
											icon: 'success',
											confirmButtonText: 'OK'
										}).then((result) => {
											if (result.isConfirmed) {
												document.getElementById('itemCreationForm').reset();
												// Any additional actions after closing the alert
											}
										});
									} else {
										// Display error message with SweetAlert
										Swal.fire({
											title: 'Error!',
											text: data.message,
											icon: 'error',
											confirmButtonText: 'OK'
										});
									}
								} catch (e) {
									console.error("Parsing error:", e);
									Swal.fire({
										title: 'Error!',
										text: 'An error occurred while processing the response.',
										icon: 'error',
										confirmButtonText: 'OK'
									});
								}
							},
							error: function(xhr, status, error) {
								// Handle error response
								alert("Failed to submit form. Please try again. Error: " + error);
							}
						});
					});
				});
			</script>

			<!------------------------------------------------------------ First Content End ------------------------------------------------------------>

			<!------------------------------------------------------------ Second Section Start ------------------------------------------------------------>

			<div class="container-fluid">
				<div class="row p-3">
					<div class="col p-5 cRound " style="background-color: rgb(223, 222, 222);">
						<div class="row">
							<div class="input-group ml-3 justify-content-start">
								<div class="searchIcon fa fa-search d-flex align-items-center" style="width: 38px; height: 38px;"></div>
								<input id="searchBox" type="search" class="searchBox cRound mr-2" placeholder="Search..." style="width: 30%;">
								<input id="searchBtn" class="btnInit btnGreen text-light" type="submit" value="Search">
							</div>
						</div>
						<div class="row">
							<div class="col mt-3 d-flex justify-content-start">
								<input id="fetchActiveButton" class="btnInit btnGray" type="button" value="Load Active" style="width: auto;">
								<input id="fetchInactiveButton" class="btnInit btnGray" type="button" value="Load Inactive" style="width: auto;">
							</div>
						</div>

						<div class="row">
							<div class="col mt-2">
								<table id="activeItemsTable" class="table table-hover mt-3 backTheam">
									<thead>
										<tr style="background-color: #b4b3b3">
											<th scope="col">Code</th>
											<th scope="col">Name</th>
											<th scope="col">Price</th>
											<th scope="col">LV 01</th>
											<th scope="col">LV 02</th>
											<th scope="col">LV 03</th>
											<th scope="col">LV 04</th>
											<th scope="col">LV 05</th>
											<th scope="col">LV 06</th>
											<th scope="col">Option</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<script>
				$(document).ready(function() {
					$('#fetchActiveButton').click(function() {
						fetchItems(1, true); // 1 for active items
					});

					$('#fetchInactiveButton').click(function() {
						fetchItems(0, false); // 0 for inactive items
					});

					function fetchItems(itemStatus, isActive) {
						$.ajax({
							url: '../item/itemConfig.php',
							type: 'GET',
							data: {
								action: 'getItems',
								status: itemStatus
								// Other data for insertion...
							},
							// dataType: 'json',
							success: function(response) {
								if (response.status === "success") {

									var tableContent = '';
									$.each(response.data, function(index, item) {
										var buttonText = item.item_status === 1 ? 'Deactivate' : 'Activate';
										var buttonClass = item.item_status === 1 ? 'deactivateBtn' : 'activateBtn';
										var newStatus = item.item_status === 1 ? 0 : 1;
										tableContent += '<tr id="itemRow_' + item.Item_id + '">' +

											'<td>' + item.item_code + '</td>' +
											'<td>' + item.Item_name + '</td>' +
											'<td>' + item.price + '</td>' +
											'<td>' + item.level_1 + '</td>' +
											'<td>' + item.level_2 + '</td>' +
											'<td>' + item.level_3 + '</td>' +
											'<td>' + item.level_4 + '</td>' +
											'<td>' + item.level_5 + '</td>' +
											'<td>' + item.level_6 + '</td>' +
											'<td>' +
											(isActive ? '<button class="editBtn  btnYellow btnTable" data-id="' + item.Item_id + '">Edit</button>' : '') +
											'<button class="' + buttonClass + '" data-id="' + item.Item_id + '" data-status="' + newStatus + '">' + buttonText + '</button>' +
											'</td>' +
											'</tr>';
									});
									$('#activeItemsTable tbody').html(tableContent);
								} else {

									alert(response.message);
								}
							},
							error: function(jqXHR, textStatus, errorThrown) {
								console.log('Error: ' + textStatus + ' - ' + errorThrown);
								alert('Error: ' + textStatus + ' - ' + errorThrown);
							}
						});
					};
				});

				$(document).on('click', '.deactivateBtn, .activateBtn', function() {
					var id = $(this).data('id');
					var newStatus = $(this).data('status');

					$.ajax({
						url: '../item/itemConfig.php',
						type: 'POST',
						data: {
							action: 'toggleStatus',
							id: id,
							newStatus: newStatus
						},
						success: function(response) {
							if (response.status === "success") {
								// Using SweetAlert for success message
								Swal.fire({
									title: 'Success!',
									text: response.message,
									icon: 'success',
									confirmButtonText: 'OK'
								}).then(() => {
									var rowToUpdate = $('#itemRow_' + id);
									rowToUpdate.remove();
								});
							} else {
								// Using SweetAlert for error message
								Swal.fire({
									title: 'Error!',
									text: response.message,
									icon: 'error',
									confirmButtonText: 'OK'
								});
							}
						}
					});
				});
			</script>
			<!------------------------------------------------------------ Second Section End ------------------------------------------------------------>

			<!-- Footer -->
			<footer class="footer-container">

		</div>
	</div>

	</footer>

	</div>
	<!-- End content -->

	</div>
	<!-- End wrapper -->

	<!-- Javascript -->
	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="assets/js/jquery-migrate-3.0.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="assets/js/jquery.backstretch.min.js"></script>
	<script src="assets/js/wow.min.js"></script>
	<script src="assets/js/jquery.waypoints.min.js"></script>
	<script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="assets/js/scripts.js"></script>
	<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
	<script src="assets/js/myscript.js"></script>

</body>

</html>