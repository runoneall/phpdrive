const fileInput = document.getElementById('file');
const progressBar = document.getElementById('progress');
const submitButton = document.querySelector('input[type="submit"]');

fileInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    const formData = new FormData();
    formData.append('file', file);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'upload.php');
    xhr.upload.addEventListener('progress', (e) => {
        const progress = Math.round((e.loaded / e.total) * 100);
        progressBar.value = progress;
        if (progress === 100) {
            submitButton.click();
        }
    });
    xhr.send(formData);
});