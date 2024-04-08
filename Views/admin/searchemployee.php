<?php
require "include/head.php";

?>

<!------------------------------------------------------------ First Content Start ------------------------------------------------------------>
<div class="first-content">
	<div class="container-fluid">
		<div class="row pt-5 pl-3 pr-3">
			<h5 class="mb-1">Search Employee</h5>
			<!-- Section rectangle inside -->
			<div class="col-12 backTheam cRound ">
				<div class="row m-2">
					<div class="input-group m-5 justify-content-center">
						<div class="searchIcon fa fa-search d-flex align-items-center" style="width: 38px; height: 38px;"></div>
						<input id="searchBox" id="example_filter" type="search" class="searchBox cRound mr-2" placeholder="Search..." style="width: 30%;">
						<button id="searchBtn" class="btnInit btnGreen text-light" type="submit">
							Search
						</button>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<!------------------------------------------------------------ First Content End ------------------------------------------------------------>

<!------------------------------------------------------------ Second Section Start ------------------------------------------------------------>

<div class="container-fluid">
	<div class="row p-3">

		<div class="col p-5 cRound" style="background-color: rgb(223, 222, 222);">
			<div class="row justify-content-center">

				<table id="showTable" class="table table-hover backTheam m-0">
					<thead>
						<tr style="background-color: #b4b3b3">
							<th scope="col">Name</th>
							<th scope="col">Emp No</th>
							<th scope="col">NIC</th>
							<th scope="col">City</th>
							<th scope="col">Province</th>
							<th scope="col">Bank</th>
							<th scope="col">Mobile 1</th>
							<th scope="col">Details</th>
							<th scope="col">Inactive</th>
							<th scope="col">Password</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!------------------------------------------------------------ Second Section End ------------------------------------------------------------>

	<!-- Footer -->
	<!-- Footer -->
	<footer class="footer-container">

</div>
</div>

</footer>

</div>
<!-- End content -->

</div>
<!-- End wrapper -->
<?php
require "include/scriptlink.php";
?>
<script>
	$(document).ready(function() {
		$('#searchBtn').click(function(e) {
			e.preventDefault();
			var emp_code = $('#searchBox').val();
			console.log(emp_code);

			if (emp_code == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Please enter an employee code!',
				});
				return;
			}

			$('#showTable tbody').empty();

			$.ajax({
				url: '../../employees/getdata/getemptable.php',
				method: 'POST',
				data: {
					emp_code: emp_code,
					action: "search"
				},
				success: function(data) {
					console.log(data);
					var table = $('#showTable tbody');
					var emp;

					try {
						emp = JSON.parse(data);
					} catch (error) {
						console.error('Error parsing JSON:', error);
						return;
					}

					// Use forEach to iterate over the emp array
					emp.forEach(function(employee) {
						var row = $('<tr>');
						row.append('<td>' + employee.Name + '</td>');
						row.append('<td>' + employee['Employee No'] + '</td>'); // Assuming 'EmpNo' is correct
						row.append('<td>' + employee.NIC + '</td>');
						row.append('<td>' + employee.City + '</td>');
						row.append('<td>' + employee.District + '</td>'); // Assuming 'Province' is correct
						row.append('<td>' + employee['Bank Name'] + '</td>'); // Assuming 'Bank' is correct
						row.append('<td>' + employee['Mobile_Number'] + '</td>'); // Assuming 'Mobile1' is correct
						row.append('<td><button class="btnTable btnYellow" data-empid="' + employee.empid + '" onclick="edit(this)">Edit</button></td>');
						row.append('<td><button class="btnTable btnCream2" id="dpassword"class="dpassword" data-empid="' + employee['Employee No'] + '">Delete</button></td>');
						row.append('<td><button class="btnTable btnRed" id="cpassword" data-empid="' + employee['Employee No'] + '">reset</button></td>');


						table.append(row);
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log("error", textStatus, errorThrown);
				}
			});
		});
	});
</script>


<script>
	$(document).ready(function() {
		$('#inactive').click(function() {
			inactiveuser();
		});
	});

	function inactiveuser() {
		$.ajax({
			url: '../../employees/getdata/getemptable.php',
			method: 'POST',
			data: {
				action: 'inactive'
			},
			success: function(data) {
				var table = $('#emp_s tbody');
				var emp = JSON.parse(data);



				// Create table body
				var tbody = $('<tbody>');
				tbody.empty();

				// Use forEach to iterate over the emp array
				emp.forEach(function(employee) {
					var row = $('<tr>');
					row.append('<td>' + employee.Name + '</td>');
					row.append('<td>' + employee.NIC + '</td>');
					row.append('<td>' + employee['Employee No'] + '</td>');
					row.append('<td>' + employee['Mobile Number'] + '</td>');
					row.append('<td>' + employee.City + '</td>');
					row.append('<td>' + employee.District + '</td>');
					row.append('<td>' + employee['Bank Name'] + '</td>');
					row.append('<td><button class="activeuser"  data-empid="' + employee['Employee No'] + '">Active</button></td>');
					row.append('<td><button class="cdpassword"id="cdpassword" data-empid="' + employee['Employee No'] + '">Delete</button></td>');
					tbody.append(row);
				});

				// Append tbody to table
				table.append(tbody);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log("error", textStatus, errorThrown);
			}
		});
	}
</script>









<script>
	function edit(btn) {
		var empid = $(btn).data('empid');
		console.log(empid);
		window.location.href = 'edit_emp.php?empid=' + empid;


	}
</script>
<script>
	$(document).ready(function() {
		$(document).on('click', '.activeuser', function(e) {
			e.preventDefault();
			var empid = $(this).data('empid');
			console.log(empid);

			// SweetAlert for activating employee
			Swal.fire({
				title: 'Are you sure?',
				text: "You are about to activate this employee.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, activate it!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '../../employees/getdata/getemptable.php', // URL to your API or server-side code
						type: 'POST',
						data: {
							empid: empid,
							action: "activate"

						},
						success: function(response) {
							Swal.fire(
								'Activated!',
								'The employee has been activated.',
								'success'
							);
						},
						error: function() {
							Swal.fire(
								'Error!',
								'There was an issue activating the employee.',
								'error'
							);
						}
					});
				}
			});
		});

		$(document).on('click', '#cdpassword', function(e) {
			e.preventDefault();
			var empid = $(this).data('empid');
			console.log(empid);

			Swal.fire({
				title: 'Are you sure?',
				text: "You are about to permanently remove this user.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: '../../employees/getdata/getemptable.php',
						type: 'POST',
						data: {
							empid: empid,
							action: "delete"
						},
						success: function(response) {
							Swal.fire(
								'Deleted!',
								'The user has been removed.',
								'success'
							);
							// Additional code to update your UI
						},
						error: function() {
							Swal.fire(
								'Error!',
								'There was an issue removing the user.',
								'error'
							);
						}
					});
				}
			});
		});
	});
</script>

<script>
	//dpassword  	cpassword
	$(document).ready(function() {
		$(document).on('click', '#cpassword', function() {
			var empid = $(this).data('empid');

			Swal.fire({
				title: 'Do you want to change the password?',
				text: "This action cannot be undone",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, change it!',
				showLoaderOnConfirm: true,
				preConfirm: () => {
					return new Promise((resolve, reject) => {
						$.ajax({
							url: '../../employees/insertdata/emppassword.php',
							type: 'POST',
							data: {
								empid: empid,
								action: "emppassword"
							},
							dataType: 'json'
						}).done((response) => {
							if (response.status === 'success') {
								resolve(response);
							} else {
								reject(response);
							}
						}).fail((jqXHR, textStatus, errorThrown) => {
							Swal.showValidationMessage(`Request failed: ${textStatus}`);
							reject(jqXHR);
						});
					});
				},
				allowOutsideClick: () => !Swal.isLoading()
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
						'Changed!',
						'The password has been changed.',
						'success'
					);
				}
			}).catch((error) => {
				Swal.fire('Error!', error.responseText || 'An unknown error occurred', 'error');
			});
		});
	});
</script>

<script>
	$(document).ready(function() {
		$(document).on('click', '#dpassword', function(e) {
			e.preventDefault();
			var empid = $(this).data('empid');
			console.log(empid);
			deleteEmployee(empid);
		});
	});

	function deleteEmployee(empid) {
		Swal.fire({
			title: 'Confirm Deletion',
			text: "Are you sure you want to delete this employee? This action cannot be undone.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!',
			showLoaderOnConfirm: true,
			preConfirm: () => {
				return deleteEmployeeAjax(empid);
			},
			allowOutsideClick: () => !Swal.isLoading()
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire('Deleted!', 'The employee has been successfully deleted.', 'success');
			}
		}).catch((error) => {
			Swal.fire('Error!', error.responseText || 'An error occurred', 'error');
		});
	}

	function deleteEmployeeAjax(empid) {
		return new Promise((resolve, reject) => {
			$.ajax({
					url: '../../employees/insertdata/emppassword.php',
					type: 'POST',
					data: {
						empid: empid,
						action: "deleteemp"
					},
					dataType: 'json'
				}).done((response) => {
					console.log(response); // Check what response is being received
					if (response.status === 'success') {
						resolve(response);
					} else {
						reject(response);
					}
				})
				.fail((jqXHR, textStatus) => {
					console.log('Request failed: ', textStatus, jqXHR); // Log more details
					Swal.showValidationMessage(`Request failed: ${textStatus}`);
					reject(jqXHR);
				});
		});
	}
</script>



</body>

<script>

</script>

</html>