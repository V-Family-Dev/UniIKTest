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

for (var i = 0; i < data.length; i++) { var city=data[i]; var ops='<option value="' + city.id + '" data-postalcode="' + city.postcode + '">' + city.name_en + '</option>' ; citySelect.append(ops); } }, error: function(jqXHR, textStatus, errorThrown) { console.log("error", textStatus, errorThrown); } }); $.ajax({ url: '../../employees/getdata/getBank.php' , method: 'POST' , dataType: 'json' , data: { bankId: bankId }, success: function(data) { //console.log(data); var bankSelect=$("#bankSelect"); bankSelect.empty(); bankSelect.append('<option value="">Select a Bank</option>');

    for (var i = 0; i < data.length; i++) { var bank=data[i]; var ops='<option value="' + bank.id + '">' + bank.name + '</option>' ; bankSelect.append(ops); } }, error: function(jqXHR, textStatus, errorThrown) { console.log("error", textStatus, errorThrown); } });