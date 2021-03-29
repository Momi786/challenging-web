const createChallengeForm = document.querySelector('#create-challenge-form');
const createChallengeFieldset = document.querySelector('#create-challenge-form > fieldset');
const createChallengeButton = document.querySelector('button[form="create-challenge-form"]');
const createChallengeModal = document.getElementById('createChallengeModal');
const challengeGameSelect = document.querySelector('#challenge-game');
const challengeDate = document.querySelector('#challenge-date');

const confirmChallengeButtons = document.querySelectorAll('button.confirm-challenge');
const cancelChallengeButtons = document.querySelectorAll('button.cancel-challenge');

const reopenChallengeForms = document.querySelectorAll('.reopen-challenge-form');

window.addEventListener('load', (event) => {
    reopenChallengeForms.forEach(function (reopenChallengeForm) {
        let today = new Date();
        reopenChallengeForm.querySelector('input#reopen-challenge-date').setAttribute('min', new Date(today.setDate(today.getDate() + 1)).toISOString().slice(0, 10))
    });
});

reopenChallengeForms.forEach(function (reopenChallengeForm) {
    reopenChallengeForm.addEventListener('submit', (event) => {
        event.preventDefault();
        if (window.confirm('Are you sure you want to Re-Open this Challenge ?\nRe-Opening this Challenge will deduct the Challenge amount from your Balance.\nPress (OK) to Re-Open or (Cancel) to return back.')) {
            const XHR = new XMLHttpRequest();

            // Bind the FormData object and the form element
            const FD = new FormData(reopenChallengeForm);

            reopenChallengeForm.querySelector('fieldset').disabled = true;
            reopenChallengeForm.querySelector('button[type="submit"]').disabled = true;
            reopenChallengeForm.querySelector('button.cancel-challenge').disabled = true;

            // Define what happens on successful data submission
            XHR.addEventListener("load", function (event) {
                alert(JSON.parse(event.target.responseText).description);

                location.reload();
            });

            // Define what happens in case of error
            XHR.addEventListener("error", function (event) {
                alert('Oops! Something went wrong.');

                reopenChallengeForm.querySelector('fieldset').disabled = false;
                reopenChallengeForm.querySelector('button[type="submit"]').disabled = false;
                reopenChallengeForm.querySelector('button.cancel-challenge').disabled = false;
            });

            // Set up our request
            XHR.open("POST", "../../php-apis/reopen-challenge.php");

            // The data sent is what the user provided in the form
            XHR.send(FD);
        } else {
        }
    });
});

confirmChallengeButtons.forEach(function (confirmChallengeButton, currentIndex, listObj) {
    confirmChallengeButton.addEventListener('click', (event) => {
        if (window.confirm("Are you sure you want to confirm this Challenge ?\nOnce a Challenge is confirmed it can no longer be cancelled.\nPress (OK) to confirm or (Cancel) to return back.")) {
            const XHR = new XMLHttpRequest();
            const FD = new FormData();

            // Push our data into our FormData object
            FD.append('challenge-id', confirmChallengeButton.dataset.challengeId);

            confirmChallengeButton.disabled = true;

            // Define what happens on successful data submission
            XHR.addEventListener('load', function (event) {
                alert(JSON.parse(event.target.responseText).description);

                location.reload();
            });

            // Define what happens in case of error
            XHR.addEventListener('error', function (event) {
                alert('Oops! Something went wrong.');

                confirmChallengeButton.disabled = false;
            });

            // Set up our request
            XHR.open('POST', '../../php-apis/confirm-challenge.php');

            // Send our FormData object; HTTP headers are set automatically
            XHR.send(FD);
        } else {
        }
    });
});

cancelChallengeButtons.forEach(function (cancelChallengeButton, currentIndex, listObj) {
    cancelChallengeButton.addEventListener('click', (event) => {
        if (window.confirm("Are you sure you want to Cancel this Challenge ?\nAfter a Challenge is Cancelled the Challenge amount MINUS the service fee will be refunded.\nPress (OK) to Cancel this Challenge or (Cancel) to return back.")) {
            const XHR = new XMLHttpRequest();
            const FD = new FormData();

            // Push our data into our FormData object
            FD.append('challenge-id', cancelChallengeButton.dataset.challengeId);

            cancelChallengeButton.disabled = true;

            // Define what happens on successful data submission
            XHR.addEventListener('load', function (event) {
                alert(JSON.parse(event.target.responseText).description);

                location.reload();
            });

            // Define what happens in case of error
            XHR.addEventListener('error', function (event) {
                alert('Oops! Something went wrong.');

                cancelChallengeButton.disabled = false;
            });

            // Set up our request
            XHR.open('POST', '../../php-apis/cancel-challenge.php');

            // Send our FormData object; HTTP headers are set automatically
            XHR.send(FD);
        } else {
        }
    });
});

createChallengeModal.addEventListener('shown.bs.modal', function (event) {
    let today = new Date();
    challengeDate.setAttribute('min', new Date(today.setDate(today.getDate() + 1)).toISOString().slice(0, 10));
    challengeGameSelect.focus();
});

createChallengeModal.addEventListener('hidden.bs.modal', function (event) {
    createChallengeForm.reset();
    createChallengeForm.classList.remove('was-validated');
});



// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'

    createChallengeForm.addEventListener('submit', function (event) {
        if (!createChallengeForm.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();
            event.stopPropagation();

            //Bind the FormData object and the form element
            const FD = new FormData(createChallengeForm);

            createChallengeFieldset.disabled = true;
            createChallengeButton.disabled = true;

            const XHR = new XMLHttpRequest();

            // Define what happens on successful data submission
            XHR.addEventListener("load", function (event) {
                let responseMsg = JSON.parse(event.target.responseText);
                alert(responseMsg.description);

                if (responseMsg.status.includes('success')) {
                    location.reload();
                } else {
                    createChallengeFieldset.disabled = false;
                    createChallengeButton.disabled = false;

                    createChallengeForm.classList.remove('was-validated');

                    challengeGameSelect.focus();
                }
            });

            // Define what happens in case of error
            XHR.addEventListener("error", function (event) {
                alert('Oops! Something went wrong.');
                createChallengeFieldset.disabled = false;
                createChallengeButton.disabled = false;

                challengeGameSelect.focus();
            });

            // Set up our request
            XHR.open("POST", "../../php-apis/create-challenge.php");

            // The data sent is what the user provided in the form
            XHR.send(FD);
        }

        createChallengeForm.classList.add('was-validated');
    }, false);
})()