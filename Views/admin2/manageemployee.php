<?php
require "include/head.php";
?>


<!------------------------------------------------------------ First Content Start ------------------------------------------------------------>
<div class="first-content">
	<div class="container-fluid">
		<div class="row  pt-5 pl-1 pr-1">
			<h5 class="mb-1 ml-4">Manage Employee</h5>
			<div class="col-12">
				<!-- Section rectangle inside -->
				<div class="col backTheam cRound p-4">
					<div class="row pb-2 pt-2">

						<div class="col-md-6">
							<label for="username" class="form-label">Username</label>
							<input class="inputBox" name="username" id="username" type="text" placeholder="Username">
						</div>

					</div>
					<div class="row pb-2 pt-2">
						<div class="col-md-6">
							<label for="password" class="form-label">Password</label>
							<input class="inputBox" name="password" id="password" type="password" placeholder="Password">
						</div>
					</div>
					<div class="row pb-2 pt-2 ml-0" id="check">

					</div>
					<div class="row pb-2 pt-2">
						<div class="col-3 d-flex justify-content-start">
							<button class="btnInit btnGreen text-light" id="createBtn" name="createBtn" type="Submit" value="Create"> Create</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!------------------------------------------------------------ First Content End ------------------------------------------------------------>

<!------------------------------------------------------------ Second Section Start ------------------------------------------------------------>

<div class="container-fluid">
	<div class="row">

		<h5 class="mb-1 ml-4 mt-4">Area Acess</h5>
		<div class="col-12">
			<!-- Section rectangle inside -->
			<div class="col backTheam cRound p-4">

				<div id="area" class="row pb-2 pt-2 ml-0">
					<!-- MU - Manage Employee -->

				</div>
			</div>
		</div>
	</div>
</div>

<!------------------------------------------------------------ Second Section End ------------------------------------------------------------>
<!------------------------------------------------------------ Second Section Start ------------------------------------------------------------>

<div class="container-fluid">
	<div class="row p-3">

		<div class="col p-5 cRound" style="background-color: rgb(223, 222, 222);">
			<div class="row">
				<div class="input-group justify-content-start">
					<div class="searchIcon fa fa-search d-flex align-items-center" style="width: 38px; height: 38px;"></div>
					<input id="searchBox" type="search" class="searchBox cRound mr-2" placeholder="Search..." style="width: 30%;">
					<input id="searchBtn" class="btnInit btnGreen text-light" type="submit" value="Search">
				</div>
			</div>
			<div class="row">
				<div class="col mt-3 d-flex justify-content-start">
					<input id="inactiveUsers" onclick="active()" class="btnInit btnGray" type="submit" value="Active Users" style="width: auto;">
					<input id="inactiveUsers" onclick="inactive()" class="btnInit btnGray" type="submit" value="Inactive Users" style="width: auto;">

				</div>
			</div>
			<div class="row mt-3 justify-content-center">

				<table id="showTable" class="table table-hover backTheam m-0">
					<thead>
						<tr style="background-color: #b4b3b3">
							<th scope="col">Username</th>
							<th scope="col">Password</th>
							<th scope="col">Access Area</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Dilrukshan Jayawardane</td>
							<td>USD10300</td>
							<td>EM,CM,SM</td>
							<td>
								<input class="btnTable btnYellow" type="submit" id="editBtn" name="editBtn" value="Edit" style="width: 60px;">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

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

<?php
require "include/scriptlink.php";
?>

</body>

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
				var table = '<table border="1">';
				table += '<tr>';
				table += '<th>Username</th>';
				table += '<th>Area name </th>';
				table += '<th>Password</th>'; // Assuming this is intentional for display
				table += '<th>Actions</th>';
				table += '<th>Area Change</th>';


				table += '</tr>';
				for (var i = 0; i < data.length; i++) {
					table += '<tr>';
					table += '<td>' + data[i].user_name + '</td>';
					table += '<td>' + (data[i].accessible_areas || 'No Access') + '</td>'; // Display area names
					table += '<td><button class="edit-user-btn btnTable btnYellow" data-eid="' + data[i].admin_id + '">Change Password</button></td>';
					table += '<td><button onclick="deleteuser(' + data[i].admin_id + ')">Inactive User</button></td>';
					table += '<td><button onclick="areaupdate(' + data[i].admin_id + ')"class=" btnTable btnYellow">Edit</button></td>';


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
				var table = '<table border="1">';
				table += '<tr>';
				table += '<th>Username</th>';
				table += '<th>Action</th>';
				table += '</tr>';
				for (var i = 0; i < data.length; i++) {
					table += '<tr>';
					table += '<td>' + data[i].user_name + '</td>';
					table += '<td><button class="active-user-btn" data-eid="' + data[i].admin_id + '">Active User</button></td>';

					table += '</tr>';
				}
				table += '</table>';
				$(".table").html(table);
			}
		});
	}


	$("#createBtn").click(function(e) {
		e.preventDefault();
		var username = $("#username").val();
		var password = $("#password").val();
		var area = [];
		$.each($("input[name='myCheckbox[]']:checked"), function() {
			area.push($(this).attr('id'));
		});

		$.ajax({
			url: "../../admin/insertdata/insertuser.php",
			type: "POST",
			data: {
				username: username,
				password: password,
				area: area
			},
			success: function(response) {
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


<script>
	$(document).ready(function() {
		$(document).on('click', '.edit-user-btn', function() {
			var userId = $(this).data('eid');
			chengepw(userId);
		});
		$(document).on('click', '.delete-user-btn', function() {
			var userId = $(this).data('eid');
			console.log(userId);
			deleteuser(userId);
			active();
		});

	});


	function chengepw(id) {
		Swal.fire({
			title: 'Enter new password',
			input: 'password',
			inputAttributes: {
				autocapitalize: 'off',
				required: 'required'
			},
			showCancelButton: true,
			confirmButtonText: 'Submit',
			showLoaderOnConfirm: true,
			preConfirm: (password) => {
				$.ajax({
					url: "../../admin/update.php",
					type: "POST",
					data: {
						id: id,
						password: password,
						action: "changePassword"
					},
					success: function(response) {
						console.log(response);
						Swal.fire({
							title: 'Success!',
							text: 'Password changed successfully',
							icon: 'success',
							confirmButtonText: 'OK'
						});
						active();
					},
					error: function() {
						Swal.fire({
							title: 'Error!',
							text: 'There was an error changing the password',
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}
				});
			},
			allowOutsideClick: () => !Swal.isLoading()
		});
	}

	function deleteuser(id) {

		Swal.fire({
			title: 'Are you sure you want to delete this user?',
			showCancelButton: true,
			confirmButtonText: 'Yes',
			showLoaderOnConfirm: true,
			preConfirm: () => {
				$.ajax({
					url: "../../admin/update.php",
					type: "POST",
					data: {
						id: id,
						action: "deleteUser"
					},
					success: function(response) {
						console.log(response);
						Swal.fire({
							title: 'Success!',
							text: 'User deleted successfully',
							icon: 'success',
							confirmButtonText: 'OK'
						});
						active();
					},
					error: function() {
						Swal.fire({
							title: 'Error!',
							text: 'There was an error deleting the user',
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}
				});
			},
			allowOutsideClick: () => !Swal.isLoading()
		});
	}
</script>

<script>
	function areaupdate(id) {
		// First, fetch the list of areas and the user's current access status
		$.ajax({
			url: "../../admin/getdata/getUserAreas.php",
			type: "POST",
			data: {
				userId: id
			},
			dataType: "json",
			success: function(areas) {
				// Check if areas is an array and has elements
				if (Array.isArray(areas) && areas.length > 0) {
					// Build the HTML for the checkboxes
					var checkboxesHtml = areas.map(function(area) {
						return '<input type="checkbox" id="area_' + area.area_id + '" ' +
							(area.isAccessible ? 'checked' : '') +
							'><label for="area_' + area.area_id + '">' + area.area_name + '</label><br>';
					}).join('');

					// Display the Swal with the checkboxes
					Swal.fire({
						title: 'Update Area Access',
						html: checkboxesHtml,
						focusConfirm: false,
						preConfirm: () => {
							// Collect the states of checkboxes
							var selectedAreas = areas.map(function(area) {
								return {
									id: area.area_id,
									isAccessible: $('#area_' + area.area_id).is(':checked')
								};
							});

							// Send the updated data to the server
							return $.ajax({
								url: "../../admin/insertdata/updateUserAreas.php",
								type: "POST",
								data: {
									userId: id,
									areas: JSON.stringify(selectedAreas)
								},
								dataType: "json"
							});
						}
					}).then((result) => {
						// Handle the server response
						if (result.value) {
							active();
							Swal.fire('Success', 'Area access updated successfully', 'success');

						}
					});
				} else {
					// Handle empty or invalid data
					Swal.fire('Error', 'Failed to load areas or invalid data format', 'error');
				}
			},
			error: function(xhr, status, error) {
				// Handle AJAX error
				Swal.fire('Error', 'AJAX Error: ' + error, 'error');
			}
		});
	}
</script>

<script>
	$(document).on('click', '.active-user-btn', function() {
		var userId = $(this).data('eid');

		Swal.fire({
			title: 'Are you sure you want to activate this user?',
			showCancelButton: true,
			confirmButtonText: 'Yes',
			showLoaderOnConfirm: true,
			preConfirm: () => {
				return $.ajax({
					url: "../../admin/update.php",
					type: "POST",
					data: {
						id: userId,
						action: "activeuser"
					},
					dataType: "json" // Ensure you expect a JSON response
				});
			},
			allowOutsideClick: () => !Swal.isLoading()
		}).then((result) => {
			if (result.isConfirmed && result.value) {
				if (result.value.status === 'success') {
					Swal.fire({
						title: 'Success!',
						text: 'User activated successfully',
						icon: 'success',
						confirmButtonText: 'OK'

					});
					inactive();
				} else {
					Swal.fire({
						title: 'Error!',
						text: result.value.message || 'There was an error activating the user',
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			}
		});
	});
</script>


<script>
	$(document).ready(function() {
		function loadCheckboxes(action, container) {
			$.ajax({
				url: "../../admin/getdata/getcheckbox.php",
				type: "POST",
				dataType: "json",
				data: {
					action: action
				},
				success: function(data) {
					var check = $(container).empty();
					for (var i = 0; i < data.length; i++) {
						var id = data[i].area_id;
						var name = data[i].area_name;
						var status = data[i].area_status;
						var checkbox = status == 1 && action == "getCheckbox" ? 'checked' : '';
						var names = action == "getCheckbox" ? "myCheckboxshow[]" : "myCheckbox[]";

						var checkboxHtml = '<div class="col-sm-1"><div class="row"><input id="' + id + '" type="checkbox" name="' + names + '" ' + checkbox +
							'><label for="' + id + '" class="form-label ml-2"><strong>' + name + '</strong></label></div></div>';
						$(container).append(checkboxHtml);
					}
				}
			});
		}

		loadCheckboxes("getCheckbox", "#area");
		loadCheckboxes("getactiveCheckbox", "#check");

		$(document).on("change", "input[name='myCheckboxshow[]']", function() {
			var checkboxId = this.id;
			var checkboxStatus = this.checked ? 1 : 0;

			$.ajax({
				url: "../../admin/insertdata/updateCheckboxStatus.php",
				type: "POST",
				data: {
					id: checkboxId,
					status: checkboxStatus
				},
				success: function(response) {
					console.log(response);
				}
			});
		});
	});
</script>


</html>