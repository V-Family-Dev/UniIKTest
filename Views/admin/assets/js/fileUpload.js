var selectedFiles = [];

// Function to display the list of selected files
function displayFileUploadList() {
    var fileUploadList = document.getElementById('fileUploadList');
    fileUploadList.innerHTML = ''; // Clear previous content

    document.getElementById('teleMsg').innerHTML = "Telephone Numbers to Upload";

    selectedFiles.forEach(function (file, index) {
        var listItem = document.createElement('li');
        listItem.className = 'list-group-item';
        listItem.textContent = file.name;

        // Button to remove the file from the list
        var removeButton = document.createElement('button');
        removeButton.className = 'btn btn-danger btn-sm float-right';
        removeButton.textContent = 'Remove';
        removeButton.addEventListener('click', function () {
            selectedFiles.splice(index, 1);
            listItem.remove();
        });

        listItem.appendChild(removeButton);
        fileUploadList.appendChild(listItem);
    });
}

// Event listener for file input change
document.getElementById('inputFile').addEventListener('change', function (e) {
    selectedFiles.push(...e.target.files);
    displayFileUploadList();
});

// Event listener for upload button click
document.getElementById('uploadButtons').addEventListener('click', function () {
    if (selectedFiles.length === 0) {
        alert('Please select a file!');
        return;
    }

    console.log('Files selected, starting processing...');

    // Your file processing logic goes here

    // Display an alert message with the names of the uploaded files
    var fileNames = selectedFiles.map(file => file.name).join(', ');
    alert('Files uploaded: ' + fileNames);

    // Clear the selected files list after processing
    selectedFiles = [];
    displayFileUploadList();
});