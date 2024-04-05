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

					<div class="col-md-3">
						<label for="empNumber" class="form-label">Employee Number</label>
						<input class="inputBox" id="employee_no" type="text" readonly>
					</div>
					<div class="col-md-3">
						<label for="refNumber" class="form-label">Reference Number</label>
						<div class="inputBox">
							<select class="inputBox" id="reference_id">
								<option value="" selected disabled>Select Reference Number</option>

							</select>
						</div>
					</div>
					<div class="col-md-3">
						<label for="priMobile" class="form-label">Primary Mobile Number</label>
						<input class="inputBox" id="phone_no" name="phone_no" type="text" placeholder="+94  Primary Mobile Number">
					</div>
					<div class="col-md-3">
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
		$("#add_empw").click(function(e) {
			e.preventDefault();
			var firstname = $("#first_name").val();
			var lastname = $("#last_name").val();
			var nic = $("#nic").val();
			var employeeno = $("#employee_no").val();
			var referenceid = $("#reference_id").val();
			var phoneno = $("#phone_no").val();
			var whatsappno = $("#whatsapp_no").val();

			var province = $("#province").val();
			var district = $("#districtsdata").val();
			var city = $("#citydata").val();
			var postalcode = $("#postalCode").val();
			var bankname = $("#bankSelect").val();
			var bankCode = $("#bankSelect").val();
			var branchname = $("#branchselect").val();
			var branchcode = $("#branchCode").val();
			var accountholdername = $("#accountHolderName").val();
			var accountnum = $("#AccountNum").val();
			//convert the form data into a FormData object
			var formData = new FormData();
			formData.append('first_name', firstname);
			formData.append('last_name', lastname);
			formData.append('nic', nic);
			formData.append('employee_no', employeeno);
			formData.append('reference_id', referenceid);
			formData.append('phone_no', phoneno);
			formData.append('whatsapp_no', whatsappno);
			console.log($('#address').val());
			formData.append('address', $('#address').val());
			formData.append('province', province);
			formData.append('district', district);
			formData.append('city', city);
			formData.append('postalCode', postalcode);
			formData.append('bankSelect', bankname);
			formData.append('bankCode', bankCode);
			formData.append('branchselect', branchname);
			formData.append('branchCode', branchcode);
			formData.append('accountHolderName', accountholdername);
			formData.append('AccountNum', accountnum);

			console.log(formData);
			$.ajax({
				url: "../../employees/insertdata/inemployee.php",
				type: "POST",
				data: formData,
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

<?php
require "include/scriptlink.php";
?>


</body>

<script>

</script>

</html>