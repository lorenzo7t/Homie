document.addEventListener('DOMContentLoaded', function () {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const validFileTypes = ['image/jpeg', 'image/png'];

    uploadArea.addEventListener('dragover', function (event) {
        event.preventDefault();
        uploadArea.classList.add('dragging');
    });

    uploadArea.addEventListener('dragleave', function () {
        uploadArea.classList.remove('dragging');
    });

    uploadArea.addEventListener('drop', function (event) {
        event.preventDefault();
        uploadArea.classList.remove('dragging');
        const files = event.dataTransfer.files;
        if (files.length) {
            handleFileUpload(files[0]);
        }
    });

    uploadArea.addEventListener('click', function () {
        fileInput.click();
    });

    fileInput.addEventListener('change', function () {
        if (fileInput.files.length) {
            handleFileUpload(fileInput.files[0]);
        }
    });

    function handleFileUpload(file) {
        if (validFileTypes.includes(file.type)) {
            uploadArea.classList.remove('error');
            uploadArea.querySelector('label').textContent = `File selezionato: ${file.name}`;
        } else {
            uploadArea.classList.add('error');
            uploadArea.querySelector('label').textContent = 'Formato file non valido. Seleziona un file JPEG o PNG.';
            fileInput.value = ''; // Reset the input so that the error message can be cleared if the user reselects a file
        }
    }
});