const depositForm = document.querySelector('#deposit-form');
const depositModal = document.getElementById('depositModal');
const depositAmountField = document.getElementById('deposit-amount');
const depositFieldset = document.querySelector('#deposit-form > fieldset');
const depositButton = document.querySelector('button[form="deposit-form"]');

depositModal.addEventListener('shown.bs.modal', function (event) {
    depositAmountField.focus();
});

depositModal.addEventListener('hidden.bs.modal', function (event) {
    depositForm.reset();
    depositForm.classList.remove('was-validated');
});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'

    depositForm.addEventListener('submit', function (event) {
        if (!depositForm.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();
            event.stopPropagation();

            //Bind the FormData object and the form element
            const FD = new FormData(depositForm);
            FD.append('client-time', new Date());

            depositFieldset.disabled = true;
            depositButton.disabled = true;

            const XHR = new XMLHttpRequest();

            // Define what happens on successful data submission
            XHR.addEventListener("load", function (event) {
                let responseMsg = JSON.parse(event.target.responseText);
                alert(responseMsg.description);

                if (responseMsg.status.includes('success')) {
                    location.reload();
                } else {
                    depositFieldset.disabled = false;
                    depositButton.disabled = false;

                    depositForm.classList.remove('was-validated');

                    depositAmountField.focus();
                }
            });

            // Define what happens in case of error
            XHR.addEventListener("error", function (event) {
                alert('Oops! Something went wrong.');
                depositFieldset.disabled = false;
                depositButton.disabled = false;

                depositAmountField.focus();
            });

            // Set up our request
            XHR.open("POST", "../../php-apis/dummy-deposit.php");

            // The data sent is what the user provided in the form
            XHR.send(FD);
        }

        depositForm.classList.add('was-validated')
    }, false);

})()