document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("changePasswordForm");
    const responseMessage = document.getElementById("passwordresponseMessage");
    const passwordError = document.getElementById("password_error");

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        const oldPassword = document.getElementById("old_password").value;
        const newPassword = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm_password").value;

        if (newPassword !== confirmPassword) {
            passwordError.textContent = "Le nuove password non coincidono.";
            return;
        }

        fetch('change_password.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                responseMessage.textContent = 'Password aggiornata con successo!';
                responseMessage.style.color = 'green';
                oldPassword.value = '';
                newPassword.value = '';
                confirmPassword.value = '';

                //window.location.reload();
            } else {
                responseMessage.textContent = 'Errore durante l\'aggiornamento del profilo.';
                responseMessage.style.color = 'red';
            }
        })
        .catch(error => {
            responseMessage.textContent = 'Errore durante la richiesta: ' + error.message;
            responseMessage.style.color = 'red';
            console.error('Error:', error);
        });
    });
});
