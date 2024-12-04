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
