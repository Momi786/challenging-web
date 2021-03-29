const changePassForm = document.querySelector('#change-password-form');
const changePassFieldset = document.querySelector('#change-password-form > fieldset');
const changePassButton = document.querySelector('button[form="change-password-form"]');
const passwordModal = document.querySelector('#passwordModal');
const currentPasswordField = document.querySelector('#currentPassword');

passwordModal.addEventListener('hidden.bs.modal', (event) => {
    changePassForm.reset();
});

passwordModal.addEventListener('shown.bs.modal', function (event) {
    currentPasswordField.focus();
});


changePassForm.addEventListener('submit', (event) => {
    event.preventDefault();

    //Bind the FormData object and the form element
    const FD = new FormData(changePassForm);

    changePassFieldset.disabled = true;
    changePassButton.disabled = true;

    const XHR = new XMLHttpRequest();

    // Define what happens on successful data submission
    XHR.addEventListener("load", function (event) {
        let responseMsg = JSON.parse(event.target.responseText);
        alert(responseMsg.description);

        if (responseMsg.status.includes('success')) {
            bootstrap.Modal.getInstance(passwordModal).hide();
        } else {
        }

        changePassFieldset.disabled = false;
        changePassButton.disabled = false;

        currentPasswordField.focus();
    });

    // Define what happens in case of error
    XHR.addEventListener("error", function (event) {
        alert('Oops! Something went wrong.');
        changePassFieldset.disabled = false;
        changePassButton.disabled = false;
    });

    // Set up our request
    XHR.open("POST", "../../php-apis/change-password.php");

    // The data sent is what the user provided in the form
    XHR.send(FD);
});