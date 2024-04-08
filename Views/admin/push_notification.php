<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Push Notification - UNIKONE SOLUTION</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500&display=swap">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/media-queries.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
	<link rel="stylesheet" href="assets/css/mycss.css">

</head>

<body>
	<div class="wrapper">
		<!-- Wrapper -->
		<nav class="sidebar">

			<!-- close sidebar menu -->

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
							<a href="#">Create Sale Order</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#messages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="messages">
						<i class="fas fa-envelope"></i>Messages
					</a>
					<ul class="collapse list-unstyled" id="messages">
						<li>
							<a href="Send SMS.html">Send SMS</a>
						</li>
						<a href="Push Notification.html">Push Notification</a>
					</ul>
				</li>
				<li>
					<a href="UpgradeDowngrade.html"><i class="fa fa-sort "></i>Upgrade/Downgrade</a>
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
								</a>
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
					<div class="row pt-5 pl-3 pr-3 mb-3">
						<h5 class="mb-1">Push Notification</h5>
						<!-- Section rectangle inside -->
						<div class="col-12 backTheam cRound pb-4">
							<div class="row">
								<div class="input-group justify-content-end p-2">
									<input id="noticeBox" type="notice" class="noticeBox cRound text-center" style="width: 30%;" placeholder="Message Count" readonly>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-5 p-5 m-2 cRound" style="background-color: #dedede;">
									<div class="row justify-content-center">
										<div class="col-4">
											<div class="row justify-content-center">
												<label for="option1" style="color: red;font-weight: bold;" Send class="ml-2">Only Use Employee ID To send Push
													Notification</label>
											</div>
										</div>
									</div>
									<div class="row mt-4">
										<h6>Custom Phone Numbers</h6><!-- 
									<label for="address" class="form-label">Address</label> -->
										<div class="input-group">
											<textarea id="address" name="address" class="form-control textArea" rows="2" cols="50" style="width: calc(100% - 2rem);"></textarea>
											<button type="button" class="btn btn-success mt-2" id="addNumbersButton">Add
												ID</button>
										</div>
									</div>


									<!-- File Upload Form -->
									<form id="fileUploadForm" class="mb-3">
										<div class="form-group">
											<h6 class="mt-4 text-center">Upload Excel File</h6>
											<input type="file" class="form-control-file" id="inputFile" accept=".xlsx, .xls" multiple>
										</div>

										<div class="mt-4" style="max-height: 200px; overflow-y: auto;">
											<h6 id="teleMsg"></h6>
											<ul id="fileUploadList" class="list-group">
												<!-- Telephone numbers will be appended here -->
											</ul>
										</div>

										<button type="button" class="btn btn-primary btn-block mt-2" id="uploadButton">Upload</button>
									</form>
								</div>

								<div class="col-5 p-5 m-2 cRound" style="background-color: rgb(223, 222, 222);">
									<div class="row">
										<div class="col-12">
											<label for="msgList" class="form-label">Select Message</label>
											<div class="inputBox">
												<select class="inputBox" name="massageid" id="massageid">
													<option value="" selected>Select Message</option>

												</select>
											</div>
										</div>
										<div class="col-12">
											<label for="msgTitle" class="form-label">Message Title</label>
											<input class="inputBox" name="title" id="title" type="text" placeholder="Edit message title here...">
										</div>
									</div>

									<!-- SMS Message Section -->
									<div class="mt-4">
										<h6>Compose SMS Message</h6>
										<textarea name="message" id="message" class="form-control textArea" rows="3" placeholder="Enter your message here..."></textarea>
										<button type="button" class="btn btn-success mt-2" id="sendpush">Send
											SMS</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!------------------------------------------------------------ First Content End ------------------------------------------------------------>
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
	<script src="assets/js/fileUpload.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</body>


<script>
	$(document).ready(function() {
		$('#sendpush').click(function() {
			var numbers = $('#fileUploadList li span').map(function() {
				return $(this).text();
			}).get();

			var message = $('#message').val();
			var title = $('#title').val();
			var mid = $('#massageid').val();
			console.log(mid);
			console.log(message);
			console.log(title);
			if (numbers.length == 0) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Please add at least one number to the list!',
				});
				return;
			}
			if (message == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Please enter a message!',
				});
				return;
			}
			if (title == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Please enter a title!',
				});
				return;
			}
			if (mid == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Please select a message!',
				});
				return;
			}
			$.ajax({
				url: '../../admin/sendmsg/pushcontroler.php',
				type: 'POST',
				data: {
					action: 'sendsms',
					phone: numbers,
					messageid: mid,
					title: title,
					message: message
				},
				success: function(response) {
					var data = JSON.parse(response);
					if (data.status == 'success') {
						Swal.fire({
							icon: 'success',
							title: 'Success',
							text: 'Message sent successfully!',
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'An error occurred while sending the message!',
						});
					}
				}
			});
		});
	});
</script>




<script>
	function addNumberToList(number) {
		var list = document.getElementById('fileUploadList');
		if (Array.from(list.children).some(li => li.textContent.includes(number))) {


			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'This number is already in the list!' + number,
			});
			return;
		}

		var li = document.createElement('li');
		li.classList.add('list-group-item');

		var span = document.createElement('span');
		span.textContent = number;
		li.appendChild(span);

		var deleteButton = document.createElement('button');
		deleteButton.textContent = 'Remove';
		deleteButton.className = 'delete-btn btn btn-danger btn-sm float-right';
		deleteButton.onclick = function() {
			list.removeChild(li);
		};
		li.appendChild(deleteButton);

		list.appendChild(li);
	}

	$(document).ready(function() {
		$('#addNumbersButton').click(function() {
			var input = $('#address').val().trim();
			var numbers = input.split(" ").filter(n => n);
			numbers.forEach(function(number) {
				if (number.match(/^USC\d{4}$/) || number.match(/^USC\d{5}$/) || number.match(/USD\d+/g)) {
					addNumberToList(number);
				}
			});
			$('#address').val('');
		});

		document.getElementById('uploadButton').addEventListener('click', function() {
			var file = document.getElementById('inputFile').files[0];
			if (!file) {
				alert("No file selected.");
				return;
			}

			var reader = new FileReader();

			reader.onload = function(e) {
				try {
					var data = new Uint8Array(e.target.result);
					var workbook = XLSX.read(data, {
						type: 'array'
					});
					var firstSheetName = workbook.SheetNames[0];
					var worksheet = workbook.Sheets[firstSheetName];
					var columnData = XLSX.utils.sheet_to_json(worksheet, {
						header: 1
					}).map(row => row[0]);

					var filteredData = [];

					filteredData = columnData.filter(item => item && item.toString().match(/^USC\d{4}$/));

					filteredData.forEach(function(item) {
						addNumberToList(item);
					});
				} catch (error) {
					console.error("Error reading file:", error);
					alert("Error reading file. Please make sure it's a valid Excel file.");
				}
			};

			reader.onerror = function() {
				console.error("Error reading file.");
				alert("An error occurred while reading the file.");
			};

			reader.readAsArrayBuffer(file);
		});
	});
</script>

<script>
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
</script>







</html>