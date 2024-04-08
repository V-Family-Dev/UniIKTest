<?php
require "include/head.php";
?>




<!------------------------------------------------------------ First Content Start ------------------------------------------------------------>
<div class="first-content">
	<div class="container-fluid">
		<div class="row pt-5 pl-3 pr-3">
			<h5 class="mb-1">Create Employee</h5>
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
						<input class="inputBox" id="nic" type="text" placeholder="NIC Number">
					</div>

				</div>

				<div class="row pb-2 pt-2">


					<div class="col-md-4">
						<label for="refNumber" class="form-label">Reference Number</label>
						<div class="inputBox">
							<select class="inputBox" id="reference_id">
								<option value="" selected disabled>Select Reference Number</option>

							</select>
						</div>
					</div>
					<div class="col-md-4">
						<label for="priMobile" class="form-label">Primary Mobile Number</label>
						<input class="inputBox" id="phone_no" name="phone_no" type="text" placeholder="+94  Primary Mobile Number">
					</div>
					<div class="col-md-4">
						<label for="secMobile" class="form-label">Whastapp Mobile Number</label>
						<input class="inputBox" id="whatsapp_no" name="whatsapp_no" type="text" placeholder="+94  Whastapp Mobile Number">
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
					<input class="inputBox" id="bankCode" type="text" readonly>
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
			<button class="btnInit btnGreen text-light" type="submit" id="add_empw" name="Create" value="Create"> Create</button>
			<button class="btnInit btnBlack text-light" type="submit" id="clearBtn" name="Create" value="Clear"> Clear</button>
		</div>
	</div>
</div>
<!------------------------------------------------------------ Third Section End ------------------------------------------------------------>

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
require "../../include/script.php";
?>
<?php
require "include/scriptlink.php";
?>

<script>
	$(document).ready(function() {
		$("#clearBtn").click(function(e) {
			e.preventDefault();
			$("#first_name").val('');
			$("#last_name").val('');
			$("#nic").val('');
			$("#reference_id").val('');
			$("#phone_no").val('');
			$("#whatsapp_no").val('');
			$("#address").val('');
			$("#province").val('');
			$("#districtsdata").val('');
			$("#citydata").val('');
			$("#postalCode").val('');
			$("#bankSelect").val('');
			$("#bankCode").val('');
			$("#branchselect").val('');
			$("#branchCode").val('');
			$("#accountHolderName").val('');
			$("#AccountNum").val('');



		});
	});
</script>


<script>
	$(document).ready(function() {
		$("#add_empws").click(function(e) {
			e.preventDefault();
			first_name: $('#first_name').val();
			last_name: $('#last_name').val();
			nic: $('#nic').val();
			reference_id: $('#reference_id').val();
			phone_no: $('#phone_no').val();
			whatsapp_no: $('#whatsapp_no').val();
			address: $('#address').val();
			province: $('#province').val();
			districts: $('#districtsdata').val();
			city: $('#citydata').val();
			postalCode: $('#postalCode').val();
			bankName: $('#bankSelect').val();
			bankCode: $('#bankCode').val();
			branchName: $('#branchselect').val();
			branchCode: $('#branchCode').val();
			accountHolderName: $('#accountHolderName').val();
			AccountNum: $('#AccountNum').val();


			$.ajax({
				url: "../../employees/insertdata/inemployee.php",
				type: "POST",
				data: {
					first_name: first_name,
					last_name: last_name,
					nic: nic,
					reference_id: reference_id,
					phone_no: phone_no,
					whatsapp_no: whatsapp_no,
					address: address,
					province: province,
					districts: districts,
					city: city,
					postalCode: postalCode,
					bankName: bankName,
					bankCode: bankCode,
					branchName: branchName,
					branchCode: branchCode,
					accountHolderName: accountHolderName,
					AccountNum: AccountNum
				},
				processData: false,
				contentType: false,
				success: function(data) {
					console.log(data);

					Swal.fire({
						title: 'Success!',
						text: 'Employee added successfully',
						icon: 'success',
						confirmButtonText: 'OK'
					});

				},
				error: function(xhr, status, error) {
					Swal.fire({
						title: 'Error!',
						text: 'There was an error adding the Employee',
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
		$("#add_empw").click(function(e) {
			e.preventDefault();

			var formData = {
				first_name: $('#first_name').val(),
				last_name: $('#last_name').val(),
				nic: $('#nic').val(),
				reference_id: $('#reference_id').val(),
				phone_no: $('#phone_no').val(),
				whatsapp_no: $('#whatsapp_no').val(),
				address: $('#address').val(),
				postalCode: $('#postalCode').val(),
				bankCode: $('#bankCode').val(),
				branchCode: $('#branchCode').val(),
				accountHolderName: $('#accountHolderName').val(),
				AccountNum: $('#AccountNum').val()
			};
			console.log(formData);
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

			$.ajax({
				url: "../../employees/insertdata/inemployee.php",
				type: "POST",
				data: formData,
				success: function(response) {
					
					if (response.status === "success") {
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
				},
				error: function(xhr, status, error) {
					Swal.fire({
						title: 'Error!',
						text: 'There was an error adding the Employee',
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			});
		});
	});
</script>



</body>

<script>

</script>

</html>