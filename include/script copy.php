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

 for (var i = 0; i < data.length; i++) { var branch=data[i]; var ops='<option value="' + branch.id + '" data-bankid="' + branch.id + '">' + branch.name + '</option>' ; branchSelect.append(ops); } }, error: function(jqXHR, textStatus, errorThrown) { console.log("error", textStatus, errorThrown); } }); $("#branchselect").change(function() { var branchCode=$("#branchselect option:selected").val(); $("#branchCode").val(branchCode); });