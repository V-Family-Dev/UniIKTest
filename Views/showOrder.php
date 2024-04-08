<?php
require '../include/auth.php';





?>

<!-- Wrapper -->
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
					<a href="Sale Order Return.html">Sale Order Return</a>
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
<div class="overlay"></div>
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
						<i class="fa fa-calendar fa-lg mr-2" style="font-size: 18px;"></i>
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
	<div class="first-content">
		<div class="container-fluid">
			<div class="row pt-5 pl-3 pr-3">
				<h5 class="mb-1">Search Sale Orders</h5>
				<!-- Section rectangle inside -->
				<div class="col-12 backTheam cRound ">
					<div class="row m-2">
						<div class="input-group m-5 justify-content-center">
							<div class="searchIcon fa fa-search d-flex align-items-center" style="width: 38px; height: 38px;"></div>
							<input id="searchBox" type="search" class="searchBox cRound mr-2" placeholder="Search..." style="width: 30%;">
							<input id="searchBtn" class="btnInit btnGreen text-light" type="submit" value="Search">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<form id="fileUploadForm" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="button" value="Upload File" id="uploadButton">
		</form>
		<div id="uploadStatus"></div>
		<div class="row p-3">

			<div class="col p-5 cRound" style="background-color: rgb(223, 222, 222);">
				<div class="row justify-content-center">

					<table id="showTable" class="table table-hover backTheam m-0">
						<thead>
							<tr style="background-color: #b4b3b3">
								<th scope="col">SO No</th>
								<th scope="col">Person Name</th>
								<th scope="col">Emp No</th>
								<th scope="col">Item Code</th>
								<th scope="col">Item Name</th>
								<th scope="col">Sale Date</th>
								<th scope="col">Delivery Date</th>
								<th scope="col">Return Date</th>
								<th scope="col">Quantity</th>
								<th scope="col">wallet</th>
								<th scope="col">Options</th>
								<th scope="col">Options</th>

							</tr>
						</thead>
						<tbody id="salesOrderTable">
							<tr>

								<!-- <td>
											<input class="btnTable btnBlack text-light" type="submit" id="editBtn" name="editBtn" value="Edit">
											<input class="btnTable btnGreen text-light" type="submit" id="actionBtn" name="actionBtn" value="Action">
										</td> -->
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>



	<div id="popupForm" style="display: none;">
		<form id="updateForm">
			<input type="hidden" id="soId" name="soId" value="">
			<label for="deliveryDate">Delivery Date:</label>
			<input type="date" id="deliveryDate" name="deliveryDate">
			<label for="returnDate">Return Date:</label>
			<input type="date" id="returnDate" name="returnDate">
			<button type="submit">Submit</button>
		</form>
	</div>

	<script>
		function openPopup(soId) {
			$('#soId').val(soId);
			$('#popupForm').show();
		}

		$(document).ready(function() {
			$('#updateForm').on('submit', function(event) {
				event.preventDefault();

				var soId = $('#soId').val();
				var deliveryDate = $('#deliveryDate').val();
				var returnDate = $('#returnDate').val();

				$.ajax({
					url: '../wallet/walletConfig.php',
					type: 'POST',
					data: {
						action: 'updateOrder',
						soId: soId,
						deliveryDate: deliveryDate,
						returnDate: returnDate
					},
					success: function(response) {
						console.log(response);
						$('#popupForm').hide();
					},
					error: function(xhr, status, error) {
						console.error(error);
					}
				});
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			// Fetch all sales order details
			$.ajax({
				url: '../salesOrder/showOrderConfig.php',
				type: 'GET',
				data: {
					action: 'salesdata'
				},
				success: function(response) {
					// Check if the response is not empty
					if (response.data.length > 0) {
						// Loop through the response and append the data to the table
						response.data.forEach(function(data) {
							var walletLink = `<td ><a href="wallet.php?employee_no=${data.employee_no}" class="btn btn-primary">Wallet</a></td>`;

							$('#salesOrderTable').append(`
                                <tr>
                                    <td>${data.so_id}</td>
                                    <td>${data.first_name} ${data.last_name}</td>
                                    <td>${data.employee_no}</td>
                                    <td>${data.item_code}</td>
                                    <td>${data.Item_name}</td>
                                    <td>${data.sales_date}</td>
                                    <td>${data.delivery_date}</td>
                                    <td>${data.return_date}</td>                               
                                    <td>${data.quantity}</td>
									${walletLink}
                                    <td>
                                        <button class="btnTable btnBlack text-light" onclick="openPopup(${data.so_id})">Action</button>
                                    </td>
                                    <td>
                                        <button class="btnTable btnBlack text-light" onclick="openPopup(${data.so_id})">Delete</button>
                                    </td>
                                </tr>
                            `);
						});
					}
				},
				error: function(error) {
					console.log(error);
				}
			});

			$('#uploadButton').click(function() {
				var formData = new FormData();
				var fileInput = $('#fileToUpload')[0];
				formData.append('fileToUpload', fileInput.files[0]);

				$.ajax({
					url: '../wallet/walletConfig.php', // Server-side script
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function(response) {
						$('#uploadStatus').html(response);
					}
				});
			});
		});
	</script>


