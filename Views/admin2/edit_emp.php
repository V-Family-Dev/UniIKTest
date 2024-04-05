<?php
require "include/head.php";
require "../../functions/user/validate.php";
require_once '../../DB/dbconfig.php';



if (isset($_GET['empid']) && !empty($_GET['empid'])) {
	$idemp = $_GET['empid'];
	if (validateuser($conn, $idemp) == 0) {
		echo '<script type="text/javascript">';
		echo 'window.location.href = "searchemployee.php";';
		echo '</script>';
		exit();
	}

?>
	<!------------------------------------------------------------ First Content Start ------------------------------------------------------------>
	<div class="first-content">
		<div class="container-fluid">
			<div class="row pt-5 pl-3 pr-3">
				<h5 class="mb-1">Edit Employee</h5>
				<div class="col-12 backTheam p-4 cRound">
					<div class="row pb-2 pt-2">

						<div class="col-md-4">
							<label for="firstName" class="form-label">First Name</label>
							<input class="inputBox" id="first_name" name="first_name" type="text" placeholder="First Name">
						</div>
						<div class="col-md-4">
							<label for="lastName" class="form-label">Last Name</label>
							<input class="inputBox" id="last_name" name="last_name" type="text" placeholder="Last Name">
						</div>
						<div class="col-md-4">
							<label for="nicNumber" class="form-label">NIC Number</label>
							<input class="inputBox" id="nic" name="nic" type="text" placeholder="NIC Number">
						</div>

					</div>

					<div class="row pb-2 pt-2">

						<div class="col-md-3">
							<label for="empNumber" class="form-label">Employee Number</label>
							<input class="inputBox" id="employee_no" name="employee_no" type="text" readonly>
						</div>
						<div class="col-md-3">
							<label for="reference_id" class="form-label">Primary Mobile Number</label>
							<input class="inputBox" id="reference_id" name="reference_id" type="text" aria-readonly="">

						</div>
						<div class="col-md-3">
							<label for="priMobile" class="form-label">Primary Mobile Number</label>
							<input class="inputBox" id="phone_no" name="phone_no" type="text" placeholder="+94  Primary Mobile Number">
						</div>
						<div class="col-md-3">
							<label for="secMobile" class="form-label">Whastapp Mobile Number</label>
							<input class="inputBox" id="whatsapp_no" name="whatsapp_no" type="text" placeholder="+94  whastapp Mobile Number">
						</div>

					</div>

					<div class="row pb-2 pt-2">

						<div class="col-md-6">
							<label for="address" class="form-label">Address</label>
							<div class="input-group">
								<textarea id="address" name="address" class="form-control textArea" rows="3" cols="50" style="width: calc(100% - 2rem);"></textarea>
							</div>
						</div>
						<div class="col-3">
							<label for="province" class="form-label">Province</label>
							<div class="inputBox">
								<select class="inputBox" id="province" name="province">

								</select>
							</div>

							<label for="distName" class="form-label">District name</label>
							<div class="inputBox">
								<select class="inputBox" name="districts" id="districtsdata">
									<option value="" selected disabled>Select District</option>

								</select>
							</div>
						</div>
						<!--emp id-->
						<input type="hidden" name="empsid" id="empsid" value="<?= $idemp ?>">

						<div class="col-3">
							<label for="townCity" class="form-label">Town/City</label>
							<div class="inputBox">
								<select class="inputBox" name="city" id="citydata">
									<option value="" selected disabled>Select Town/City</option>

								</select>
							</div>

							<label for="postCode" class="form-label">Postal Code</label>
							<input class="inputBox" name="postalCode" id="postalCode" type="text" readonly>

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

			<h5 class="mb-1">Bank Informations</h5>
			<div class="col-12 backTheam cRound p-4">
				<div class="row pb-2 pt-2">
					<div class="col-md-3">
						<label for="bankName" class="form-label">Bank Name</label>
						<div class="inputBox">
							<select class="inputBox" id="bankSelect" name="bankName">
								<option value="" selected disabled>Select Bank Name</option>

							</select>
						</div>
					</div>

					<div class="col-md-3">
						<label for="bankCode" class="form-label">Bank Code</label>
						<input class="inputBox" id="bankcode" type="text" readonly>
					</div>

					<div class="col-md-3">
						<label for="branchName" class="form-label">Branch Name</label>
						<div class="inputBox">
							<select class="inputBox" id="branchselect" name="branchName">
								<option value="" selected disabled>Select Branch Name</option>

							</select>
						</div>
					</div>

					<div class="col-md-3">
						<label for="branchCode" class="form-label">Branch Code</label>
						<input class="inputBox" id="branchCode" name="branchCode" type="text" readonly>
					</div>
				</div>

				<div class="row pb-2 pt-2">

					<div class="col-md-3">
						<label for="accHolder" class="form-label">Account Holder Name</label>
						<input class="inputBox" id="accountHolderName" name="accountHolderName" type="text" placeholder="Account Holder Name">
					</div>
					<div class="col-md-3">
						<label for="accNumber" class="form-label">Account Number</label>
						<input class="inputBox" id="AccountNum" name="AccountNum" type="text" placeholder="Account Number">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!------------------------------------------------------------ Second Section End ------------------------------------------------------------>

	<!------------------------------------------------------------ Third Section Start ------------------------------------------------------------>

	<div class="container-fluid">
		<div class="col mt-3 d-flex justify-content-start">
			<div class="row">
				<button class="btnInit btnGreen text-light" type="submit" id="editform" name="editform" value="Submit"> Submit</button>
				<a href="searchemployee.php">
					<button class="btnInit btnBlack text-light" type="submit" id="clearBtn" name="Create" value="Clear"> Back</button></a>
			</div>
		</div>
	</div>
	<!------------------------------------------------------------ Third Section End ------------------------------------------------------------>

	<!-- Footer -->


<?php
} else {
	echo "No Employee ID";
}
?>
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

<!--script-->
<script>
	$(document).ready(function() {

		var id = "<?= $idemp ?>";
		console.log(id);
		$.ajax({
			url: "../../employees/getdata/getempdata.php",
			type: "POST",
			data: {
				empid: id,
				action: 'getempdata'
			},
			success: function(data) {
				//console.log(data);
				var emp = JSON.parse(data);
				console.log(emp);
				$('#first_name').val(emp[0]['First Name']);
				$('#last_name').val(emp[0]['Last Name']);
				$('#nic').val(emp[0].NIC);
				$('#employee_no').val(emp[0]['Employee No']);
				$('#phone_no').val(emp[0]['Phone Number']);
				$('#whatsapp_no').val(emp[0]['WhatsApp Number']);
				$('#address').val(emp[0].Address);
				$('#postalCode').val(emp[0]['Postal Code']);
				$('#bankcode').val(emp[0]['Bank ID']);
				$('#branchCode').val();
				$('#accountHolderName').val(emp[0]['Account Holder Name']);
				$('#AccountNum').val(emp[0]['Account Number']);
				$('#empsid').val(emp[0]['Employee ID']);

				var provinceId = emp[0]['Province ID'];
				var districtId = emp[0]['District ID'];
				var cityId = emp[0]['Postal Code'];
				var bankId = emp[0]['Bank ID'];





				var branchId = emp[0]['Branch ID'];
				getpro(provinceId, districtId, cityId, bankId, branchId, emp[0].postcode);
				getdis(districtId);
				getcity(cityId);
				getbank(bankId);
				getBranch(branchId, bankId);




			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.error("Error: ", textStatus, errorThrown);

			}
		});
	});

	function getpro(provinceId) {


		$.ajax({
			url: '../../employees/getdata/getempdata.php',
			method: 'POST',
			dataType: 'json',
			data: {
				action: 'getpro'
			},
			success: function(pro) {
				//console.log(pro);

				var provinceSelect = $("#province");
				provinceSelect.empty();

				provinceSelect.append('<option value="">Select a province</option>');


				for (var i = 0; i < pro.length; i++) {

					var province = pro[i];
					(province.id == provinceId) ? selected = 'selected': selected = '';
					var ops = '<option value="' + province.id + '" ' + selected + '>' + province.name_en + '</option>';
					provinceSelect.append(ops);
				}



			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log("error", textStatus, errorThrown);
			}

		});









	}

	function getdis(districtId) {
		//console.log(districtId);
		$.ajax({
			url: '../../employees/getdata/getempdata.php',
			method: 'POST',
			dataType: 'json',
			data: {
				action: 'getdis'
			},
			success: function(pro) {
				//console.log(pro);

				var districtSelect = $("#districtsdata");
				districtSelect.empty();
				districtSelect.append('<option value="">Select a District</option>');

				for (var i = 0; i < pro.length; i++) {
					var district = pro[i];
					var selected = (district.id == districtId) ? 'selected' : ''; // Select the current district
					var ops = '<option value="' + district.id + '" ' + selected + '>' + district.name_en + '</option>';
					districtSelect.append(ops);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log("error", textStatus, errorThrown);
			}
		});
	}

	function getcity(cityid) {
		//console.log(cityid);
		$.ajax({
			url: '../../employees/getdata/getempdata.php',
			method: 'POST',
			dataType: 'json',
			data: {
				action: 'getcity'
			},
			success: function(pro) {
				//console.log(pro);
				var citySelect = $("#citydata");
				citySelect.empty();
				citySelect.append('<option value="">Select a City</option>');

				for (var i = 0; i < pro.length; i++) {
					var city = pro[i];
					var selected = (city.postcode == cityid) ? 'selected' : ''; // Select the current district
					var ops = '<option value="' + city.postcode + '" ' + selected + ' data-postalcode="' + city.postcode + '">' + city.name_en + '</option>';
					citySelect.append(ops);
				}




			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log("error", textStatus, errorThrown);
			}
		});
	}

	function getbank(bankId) {

		$.ajax({
			url: '../../employees/getdata/getempdata.php',
			method: 'POST',
			dataType: 'json',
			data: {
				action: 'getbank'
			},
			success: function(pro) {
				//console.log(pro);
				var bankSelect = $("#bankSelect");
				bankSelect.empty();
				bankSelect.append('<option value="">Select a Bank</option>');

				pro.forEach(function(bank) {
					var selected = (bank.ID == bankId) ? 'selected' : ''; // Select the current district
					//console.log(selected);
					var ops = '<option value="' + bank.ID + '" ' + selected + ' data-bank="' + bank.ID + '">' + bank.name + '</option>';
					bankSelect.append(ops);
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log("error", textStatus, errorThrown);
			}
		});
	}


	function getBranch(branchId, bankId) {
		console.log(branchId);
		console.log(bankId);
		$.ajax({
			url: '../../employees/getdata/getempdata.php',
			method: 'POST',
			dataType: 'json',
			data: {
				action: 'getbranch'
			},
			success: function(pro) {
				console.log(pro);
				var branchSelect = $("#branchselect");
				branchSelect.empty().append('<option value="">Select a Branchs</option>');

				pro.forEach(function(branch) {
					var isSelected = (branch.branchID == branchId && branch.bankID == bankId) ? 'selected' : '';
					branchSelect.append(`<option value="${branch.branchID}" ${isSelected}>${branch.branchName}</option>`);
				});
				var branchcode = $("#branchselect option:selected").val();
				$("#branchCode").val(branchcode);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log("error", textStatus, errorThrown);
			}
		});

	}
</script>



<script>
	$(document).ready(function() {
		$('#editform').click(function(e) {
			e.preventDefault();

			// Gather form data into FormData object
			var empdata = new FormData();
			empdata.append('first_name', $('#first_name').val());
			empdata.append('last_name', $('#last_name').val());
			empdata.append('nic', $('#nic').val());
			empdata.append('employee_no', $('#employee_no').val());
			empdata.append('reference_id', $('#reference_id').val());
			empdata.append('phone_no', $('#phone_no').val());
			empdata.append('whatsapp_no', $('#whatsapp_no').val());
			empdata.append('address', $('#address').val());
			empdata.append('city', $('#city').val());
			empdata.append('postalCode', $('#postalCode').val());
			var bankcode = $('#bankcode').val();
			empdata.append('bankcode', bankcode);
			empdata.append('branchCode', $('#branchCode').val());
			empdata.append('accountHolderName', $('#accountHolderName').val());
			empdata.append('AccountNum', $('#AccountNum').val());
			empdata.append('empsid', $('#empsid').val());
			empdata.append('action', 'updateemp');
			console.log(empdata);
			var address = $('#address').val();
			var bankcode = $('#bankcode').val();
			console.log(address);
			console.log(bankcode);


			// Show processing dialog
			Swal.fire({
				title: 'Processing...',
				text: 'Please wait while the employee is being updated',
				icon: 'info',
				allowOutsideClick: false,
				showConfirmButton: false,
				willOpen: () => {
					Swal.showLoading();
				}
			});

			// AJAX request to update employee data
			$.ajax({
				url: '../../employees/update.php',
				method: 'POST',
				data: empdata,
				contentType: false,
				processData: false,
				success: function(data) {
					try {
						let response = JSON.parse(data);
						if (response.status === 'success') {
							Swal.fire({
								title: 'Success!',
								text: 'Employee updated successfully',
								icon: 'success',
								confirmButtonText: 'OK'
							}).then((result) => {
								if (result.isConfirmed) {
									// Redirect or other action
								}
							});
						} else {
							Swal.fire({
								title: 'Update Failed',
								text: response.message || 'The update process failed',
								icon: 'error',
								confirmButtonText: 'OK'
							});
							if (response.error) {
								console.error("Error details:", response.error);
							}
						}
					} catch (e) {
						Swal.fire({
							title: 'Error!',
							text: 'Failed to parse server response',
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					Swal.fire({
						title: 'Error!',
						text: `Error occurred: ${textStatus}, ${errorThrown}`,
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			});
		});
	});
</script>





<script>
	$(document).ready(function() {
		$('#province').select2();
		$('#districtsdata').select2();
		$('#citydata').select2();
		$('#bankSelect').select2();
		$('#branchselect').select2();
	});
</script>

<script>
	$("#province").change(function() {
		var provinceId = $("#province").val();
		$("#citydata").empty();
		$("#districtsdata").empty();
		$("#postalCode").val('');

		$.ajax({
			url: '../../employees/getdata/getDistricts.php',
			method: 'POST',
			dataType: 'json',
			data: {
				provinceId: provinceId
			},
			success: function(data) {
				console.log(data);

				var districtSelect = $("#districtsdata");
				districtSelect.empty();

				districtSelect.append('<option value="">Select a Districts</option>');

				for (var i = 0; i < data.length; i++) {
					var district = data[i];
					var ops = '<option value="' + district.id + '">' + district.name_en + '</option>';
					districtSelect.append(ops);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log("error", textStatus, errorThrown);
			}
		});

	});
	$("#districtsdata").change(function() {
		var districtId = $("#districtsdata").val();
		////console.log(districtId);

		$.ajax({
			url: '../../employees/getdata/getCity.php',
			method: 'POST',
			dataType: 'json',
			data: {
				districtId: districtId
			},
			success: function(data) {
				////console.log(data);

				var citySelect = $("#citydata");
				citySelect.empty();

				citySelect.append('<option value="">Select a City</option>');

				for (var i = 0; i < data.length; i++) {
					var city = data[i];
					var ops = '<option value="' + city.postcode + '" data-postalcode="' + city.postcode + '">' + city.name_en + '</option>';
					citySelect.append(ops);

				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log("error", textStatus, errorThrown);
			}
		});


	});
</script>
<script>
	$("#bankSelect").change(function() {
		var selectedOption = $("#bankSelect option:selected");
		console.log(selectedOption);
		var bankId = selectedOption.val();
		$("#bankcode").val(bankId);


		$("#branchselect").empty();
		$("#branchCode").val('');
		var bankis = selectedOption.data('bank');
		console.log(bankis);
		$.ajax({
			url: '../../employees/getdata/getempdata.php',
			method: 'POST',
			dataType: 'json',
			data: {
				bankID: bankis,
				action: 'getbranchs'
			},
			success: function(data) {
				////console.log(data);

				var branchSelect = $("#branchselect");
				branchSelect.empty();

				branchSelect.append('<option value="">Select a Branch</option>');

				for (var i = 0; i < data.length; i++) {
					var branch = data[i];
					var ops = '<option value="' + branch.branchID + '" data-bankid="' + branch.branchID + '">' + branch.branchName + '</option>';
					branchSelect.append(ops);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log("error", textStatus, errorThrown);
			}
		});



	});
	$("#branchselect").change(function() {
		var branchCode = $("#branchselect option:selected").val();
		$("#branchCode").val(branchCode);
	});
	$("#citydata").change(function() {
		var postalCode = $("#citydata option:selected").val();
		$("#postalCode").val(postalCode);
	}); //branchselect  	branchCode
	$("#branchselect").change(function() {
		var branchCode = $("#branchselect option:selected").val();
		$("#branchCode").val(branchCode);
	});
</script>

</html>