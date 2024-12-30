function initializeImageSwitch(isURL, obrazok) {
    // Get the radio buttons and corresponding containers
    const fileOption = document.getElementById('imageSwitchFile');
    const urlOption = document.getElementById('imageSwitchURL');
    const fileUploadContainer = document.getElementById('fileUploadContainer');
    const urlInputContainer = document.getElementById('urlInputContainer');
    const fileInput = document.getElementById('fileInput'); // File input field
    const urlInput = document.getElementById('urlInput');   // URL input field

    // Initialize based on isURL value
    if (isURL == 1) {
        urlOption.checked = true;
        fileUploadContainer.style.display = 'none';
        urlInputContainer.style.display = 'block';
        urlInput.value = obrazok;
    } else {
        fileOption.checked = true;
        fileUploadContainer.style.display = 'block';
        urlInputContainer.style.display = 'none';
        urlInput.value = '';
    }

    // Event listener to toggle between URL input and file upload
    fileOption.addEventListener('change', function () {
        if (fileOption.checked) {
            fileUploadContainer.style.display = 'block';
            urlInputContainer.style.display = 'none';
            urlInput.value = '';
        }
    });

    urlOption.addEventListener('change', function () {
        if (urlOption.checked) {
            fileUploadContainer.style.display = 'none';
            urlInputContainer.style.display = 'block';
            fileInput.value = '';
        }
    });
}
function switchForm() {
    var loginForm = document.querySelector('.form-signin');
    var signupForm = document.querySelector('.form-signup');

    if (loginForm.style.display !== 'none') {
        loginForm.style.display = 'none';
        signupForm.style.display = 'block';
    } else {
        loginForm.style.display = 'block';
        signupForm.style.display = 'none';
    }
}
function submitUserUpdateForm(event) {
    event.preventDefault();
    var form = document.getElementById('userUpForm');
    var formData = new FormData(form);
    console.log(formData);

    // Send the form data to the PHP backend using AJAX
    fetch("http://localhost/?c=admin&a=update", {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (response.ok) {
                return response.json(); // Parse the JSON response
            } else {
                throw new Error('Something went wrong');
            }
        })
        .then(updatedUsers => {
            // Update the displayed table with the updated user data
            updateTable(updatedUsers);
            alert('Changes have been saved successfully.');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
}

function updateTable(users) {
    var table = document.getElementById('userTable');
    table.innerHTML = ''; // Clear the existing table

    // Rebuild the table with the updated user data
    var tableHTML = '<tr><th>Username</th><th>Is Admin</th><th>Delete User</th></tr>';
    users.forEach(user => {
        tableHTML += '<tr>';
        tableHTML += '<td>' + user.meno + '</td>';
        tableHTML += '<td><input type="checkbox" name="admin[]" value="' + user.id + '" ' + (user.admin ? 'checked' : '') + '></td>';
        tableHTML += '<td><input type="checkbox" name="delete[]" value="' + user.id + '"></td>';
        tableHTML += '</tr>';
    });
    table.innerHTML = tableHTML;
}