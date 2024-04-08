<?php include 'include/head.php'; ?>

<!------------------------------------------------------------ First Content Start ------------------------------------------------------------>
<div class="first-content">
	<div class="container-fluid">
		<div class="row pt-5 pl-3 pr-3">
			<h5 class="mb-1">Send SMS</h5>
			<!-- Section rectangle inside -->
			<div class="col-12 backTheam cRound ">
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
									<input type="radio" id="options" name="options" value="employeeID">
									<label for="option1" class="ml-2">By Employee ID</label>
								</div>
							</div>
							<div class="col-4">
								<div class="row justify-content-center">
									<input type="radio" id="options" name="options" value="phoneNumber">
									<label for="option1" class="ml-2">By Phone Number</label>
								</div>
							</div>
						</div>
						<div class="row mt-4">
							<h6>Custom Phone Numbers</h6>
							<div class="input-group">
								<textarea id="address" name="address" class="form-control textArea" rows="2" cols="50" style="width: calc(100% - 2rem);"></textarea>
								<button type="button" class="btn btn-success mt-2" id="addNumbersButton">Add
									Numbers</button>
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
									<select name="massageid" id="massageid" class="inputBox">
										<option selected>Select Message
										</option>

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
							<button type="button" class="btn btn-success mt-2" id="sendSMSButton">Send
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

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>











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







<script>
	$(document).ready(function() {
		$('#sendSMSButton').click(function() {
			var message = $('#smsMessage').val();
			var numbers = $('#fileUploadList li span').map(function() {
				return $(this).text();
			}).get();
			var massageid = $('#massageid').val();
			var title = $('#title').val();
			var message = $('#message').val();
			var type = $('input[name="options"]:checked').val();
			var data = {
				action: 'sendmsgnew',
				message: message,
				numbers: numbers,
				massageid: massageid,
				title: title,
				message: message,
				type: type
			};
			if (!message || !massageid || !title || !message) {
				Swal.fire("Error", "Please enter a message.", "error");
				return;
			} else {
				$.ajax({
					url: '../../admin/sendmsg/msgcontroler.php',
					type: 'POST',
					data: data,
					success: function(response) {
						var jsonResponse = JSON.parse(response); // Parse the JSON response
						if (jsonResponse.status === 'success') {
							Swal.fire("Success", "Message sent successfully.", "success");
						} else {
							Swal.fire("Error", "An error occurred while sending the message.", "error");
						}
					}
				});
			}
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
			if (!input) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Please enter a phone number!',
				});
				exit;
			}

			var numbers = input.split(" ").filter(n => n);

			numbers.forEach(function(number) {
				console.log("Processing number:", number); // Debugging log
				if (number.match(/^\d{10}$/) || number.match(/^\d{9}$/) || number.match(/^\+94\d{9}$/) || number.match(/^07\d{8}$/) || number.match(/^USC\d{4}$/) || number.match(/USD\d+/g)) {
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

					var selectedOptionElement = document.querySelector('input[name="options"]:checked');
					if (!selectedOptionElement) {
						alert('Please select an option.');
						return;
					}
					var selectedOption = selectedOptionElement.value;

					var filteredData = [];
					if (selectedOption === 'employeeID') {
						filteredData = columnData.filter(item => item && item.toString().match(/^USC\d{4}$/));
					} else if (selectedOption === 'phoneNumber') {
						filteredData = columnData.filter(item =>
							item &&
							(item.toString().match(/^\d{9}$/) ||
								item.toString().match(/^\+94\d{9}$/) ||
								item.toString().match(/^\d{10}$/) || item.toString().match(/^07\d{8}$/))
						);
					}

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




</html>