const withdrawalForm = document.querySelector('#withdrawal-form');
const withdrawalModal = document.getElementById('withdrawalModal');
const withdrawalMethodField = document.getElementById('withdrawal-method');
const withdrawalFieldset = document.querySelector('#withdrawal-form > fieldset');
const withdrawalButton = document.querySelector('button[form="withdrawal-form"]');

withdrawalModal.addEventListener('shown.bs.modal', function (event) {
    withdrawalMethodField.focus();
});

withdrawalModal.addEventListener('hidden.bs.modal', function (event) {
    withdrawalForm.reset();
    withdrawalForm.classList.remove('was-validated');
});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'

    withdrawalForm.addEventListener('submit', function (event) {
        if (!withdrawalForm.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();
            event.stopPropagation();

            //Bind the FormData object and the form element
            const FD = new FormData(withdrawalForm);
            FD.append('client-time', new Date());

            withdrawalFieldset.disabled = true;
            withdrawalButton.disabled = true;

            const XHR = new XMLHttpRequest();

            // Define what happens on successful data submission
            XHR.addEventListener("load", function (event) {
                let responseMsg = JSON.parse(event.target.responseText);
                alert(responseMsg.description);

                if (responseMsg.status.includes('success')) {
                    location.reload();
                } else {
                    withdrawalFieldset.disabled = false;
                    withdrawalButton.disabled = false;

                    withdrawalForm.classList.remove('was-validated');

                    withdrawalMethodField.focus();
                }
            });

            // Define what happens in case of error
            XHR.addEventListener("error", function (event) {
                alert('Oops! Something went wrong.');
                withdrawalFieldset.disabled = false;
                withdrawalButton.disabled = false;

                withdrawalMethodField.focus();
            });

            // Set up our request
            XHR.open("POST", "../../php-apis/dummy-withdrawal.php");

            // The data sent is what the user provided in the form
            XHR.send(FD);
        }

        withdrawalForm.classList.add('was-validated')
    }, false);

})()