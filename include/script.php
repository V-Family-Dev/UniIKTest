  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
      $(document).ready(function() {
          $('#province, #districtsdata, #citydata,#reference_id,#bankSelect,#branchselect').select2();

          $("#province").change(function() {
              var provinceId = $("#province").val();
              //console.log(provinceId);

              $.ajax({
                  url: '../../employees/getdata/getDistricts.php',
                  method: 'POST',
                  dataType: 'json',
                  data: {
                      provinceId: provinceId
                  },
                  success: function(data) {
                      //console.log(data);

                      var citySelect = $("#districtsdata");
                      citySelect.empty();

                      citySelect.append('<option value="">Select a District</option>');

                      for (var i = 0; i < data.length; i++) {
                          var city = data[i];
                          var ops = '<option value="' + city.id + '">' + city.name_en + '</option>';
                          citySelect.append(ops);
                      }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log("error", textStatus, errorThrown);
                  }
              });
          });
          $("#districtsdata").change(function() {
              var districtId = $("#districtsdata").val();
              //console.log(districtId);

              $.ajax({
                  url: '../../employees/getdata/getCity.php',
                  method: 'POST',
                  dataType: 'json',
                  data: {
                      districtId: districtId
                  },
                  success: function(data) {
                      //console.log(data);

                      var citySelect = $("#citydata");
                      citySelect.empty();

                      citySelect.append('<option value="">Select a City</option>');

                      for (var i = 0; i < data.length; i++) {
                          var city = data[i];
                          var ops = '<option value="' + city.id + '" data-postalcode="' + city.postcode + '">' + city.name_en + '</option>';
                          citySelect.append(ops);

                      }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log("error", textStatus, errorThrown);
                  }
              });
              $("#citydata").change(function() {
                  var postalCode = $("#citydata option:selected").data('postalcode');
                  $("#postalCode").val(postalCode);
              });
          });
      });
  </script>
  <script>
      $(document).ready(function() {
          $.ajax({
              url: '../../employees/getdata/getBank.php',
              method: 'POST',
              dataType: 'json',
              success: function(data) {

                  var bankSelect = $("#bankSelect");
                  bankSelect.empty();

                  bankSelect.append('<option value="">Select a Bank</option>');

                  for (var i = 0; i < data.length; i++) {
                      var bank = data[i];
                      var ops = '<option value="' + bank.id + '" data-bankid="' + bank.id + '">' + bank.name + '</option>';

                      bankSelect.append(ops);
                  }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log("error", textStatus, errorThrown);
              }
          });

          $("#bankSelect").change(function() {
              var bankID = $("#bankSelect").val();
              var addbankCode = $("#bankCode");
              addbankCode.val(bankID);

              //console.log(bankID);

              $.ajax({
                  url: '../../employees/getdata/getBranch.php',
                  method: 'POST',
                  dataType: 'json',
                  data: {
                      bankID: bankID
                  },
                  success: function(data) {
                      //console.log(data);

                      var branchSelect = $("#branchselect");
                      branchSelect.empty();

                      branchSelect.append('<option value="">Select a Branch</option>');

                      for (var i = 0; i < data.length; i++) {
                          var branch = data[i];
                          var ops = '<option value="' + branch.id + '" data-bankid="' + branch.id + '">' + branch.name + '</option>';


                          branchSelect.append(ops);
                      }
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                      console.log("error", textStatus, errorThrown);
                  }

              });
              $("#branchselect").change(function() {
                  var branchCode = $("#branchselect option:selected").val();
                  $("#branchCode").val(branchCode);
              });

          });



      });
  </script>

  <script>
      //employee_no insert

      $(document).ready(function() {
          $.ajax({
              url: '../../employees/getdata/getref.php',
              method: 'POST',
              dataType: 'json',
              success: function(data) {
                  //console.log(data);
                  var employeeSelect = $("#reference_id");
                  employeeSelect.empty();
                  employeeSelect.append('<option value="">Select a Reference Id</option>');
                  for (var i = 0; i < data.length; i++) {
                      var employee = data[i];
                      var ops = '<option value="' + employee.id + '" data-employeeid="' + employee.id + '">' + employee.id + '</option>';
                      employeeSelect.append(ops);

                  }



              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log("error", textStatus, errorThrown);
              }
          });

      });
  </script>

  <script>
      $(document).ready(function() {
          $.ajax({
              url: '../../employees/getdata/getaccno.php',
              method: 'POST',
              dataType: 'json',
              success: function(data) {
                  //console.log(data);
                  var autono = $("#employee_no");
                  autono.val(data);




              },
          });
      });
  </script>

  <script>
      $(document).ready(function() {
          $.ajax({
              url: '../../employees/getdata/getProvince.php',
              method: 'POST',
              dataType: 'json',
              success: function(data) {
                  //console.log(data);
                  var provinceSelect = $("#province");
                  provinceSelect.empty();
                  provinceSelect.append('<option value="">Select a Province</option>');
                  for (var i = 0; i < data.length; i++) {
                      var province = data[i];
                      var ops = '<option value="' + province.id + '" data-provinceid="' + province.id + '">' + province.name_en + '</option>';
                      provinceSelect.append(ops);
                  }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log("error", textStatus, errorThrown);
              }
          });
      });
  </script>