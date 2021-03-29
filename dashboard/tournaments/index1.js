const createTourneyForm = document.querySelector('#create-tourney-form');
const createTourneyFieldset = document.querySelector('#create-tourney-form > fieldset');
const tourneyStartDate = createTourneyForm.querySelector('input[type="date"]');
const createTourneyButton = document.querySelector('button[form="create-tourney-form"]');
const tourneyGameSelect = document.querySelector('#tourney-game');
const createTourneyModal = document.getElementById('createTourneyModal');
const tourneyPlayersModal = document.getElementById('tourney-players-modal');
const cancelTourneyModal = document.getElementById('cancel-tourney-modal');
const reopenTourneyModal = document.getElementById('reopen-tourney-modal');
const confirmTourneyModal = document.getElementById('confirm-tourney-modal');

confirmTourneyModal.querySelector('button.confirm-tourney').addEventListener('click', () => {
    const XHR = new XMLHttpRequest();
    const FD = new FormData();

    // Push our data into our FormData object
    FD.append('tourney-id', confirmTourneyModal.querySelector('button.confirm-tourney').dataset.tourneyId);

    confirmTourneyModal.querySelector('.response-div').innerHTML = '';
    confirmTourneyModal.querySelector('button.confirm-tourney').disabled = true;

    // Define what happens on successful data submission
    XHR.addEventListener('load', function (event) {
        try {
            let responseMsg = JSON.parse(event.target.responseText);
            console.log(responseMsg);
            if (responseMsg.status === 'success') {
                responseMsg.success_msgs.forEach((success_msg) => {
                    let alert = document.createElement('div');
                    alert.classList.add('alert', 'alert-success');
                    alert.setAttribute('role', 'alert');
                    alert.textContent = success_msg;
                    confirmTourneyModal.querySelector('.response-div').appendChild(alert);
                });
                let p = document.createElement('p');
                p.textContent = 'This page will reload in 3 seconds...';
                confirmTourneyModal.querySelector('.response-div').appendChild(p);
                setTimeout(function () {
                    location.reload();
                }, 3000);
            } else {
                responseMsg.error_msgs.forEach((error_msg) => {
                    let alert = document.createElement('div');
                    alert.classList.add('alert', 'alert-danger');
                    alert.setAttribute('role', 'alert');
                    alert.textContent = error_msg;
                    confirmTourneyModal.querySelector('.response-div').appendChild(alert);
                });
                confirmTourneyModal.querySelector('button.confirm-tourney').disabled = false;
            }
        } catch (error) {
            let alert = document.createElement('div');
            alert.classList.add('alert', 'alert-danger');
            alert.setAttribute('role', 'alert');
            alert.textContent = error;
            confirmTourneyModal.querySelector('.response-div').appendChild(alert);

            confirmTourneyModal.querySelector('button.confirm-tourney').disabled = false;
        }

        bootstrap.Modal.getInstance(confirmTourneyModal).handleUpdate();
    });

    // Define what happens in case of error
    XHR.addEventListener('error', function (event) {
        let alert = document.createElement('div');
        alert.classList.add('alert', 'alert-danger');
        alert.setAttribute('role', 'alert');
        alert.textContent = 'Oops! Something went wrong. Please try again.';
        confirmTourneyModal.querySelector('.response-div').appendChild(alert);

        bootstrap.Modal.getInstance(confirmTourneyModal).handleUpdate();

        confirmTourneyModal.querySelector('button.confirm-tourney').disabled = false;
    });

    // Set up our request
    XHR.open('POST', '../../php-apis/confirm-tournament.php');

    // Send our FormData object; HTTP headers are set automatically
    XHR.send(FD);
});

confirmTourneyModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var tourneyId = button.getAttribute('data-bs-tourneyId')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.

    const XHR = new XMLHttpRequest();
    const FD = new FormData();

    // Push our data into our FormData object
    FD.append('tourney-id', tourneyId);

    // Define what happens on successful data submission
    XHR.addEventListener('load', function (event) {
        try {
            let responseMsg = JSON.parse(event.target.responseText);

            if (responseMsg.status === 'success') {
                let tourney_details = responseMsg.tourney_details;

                let gamePlusConsole = ((tourney_details.game === 'fifa_21') ? (tourney_details.game.replaceAll("_", " ").toUpperCase()) : (tourney_details.game.replaceAll("_", " ").toUpperCase())) + ' - ' + ((tourney_details.console === 'ps4' || tourney_details.console === 'pc') ? (tourney_details.console.toUpperCase()) : (tourney_details.console.toUpperCase()));
                confirmTourneyModal.querySelector('.modal-title').textContent = 'Confirm Tournament # ' + tourney_details.tournament_id + ' (' + gamePlusConsole + ')';

                confirmTourneyModal.querySelector('button.confirm-tourney').dataset.tourneyId = tourney_details.tournament_id;
            } else {
                let span = document.createElement('span');
                span.classList.add('text-danger');
                span.textContent = 'Error!';
                confirmTourneyModal.querySelector('.modal-title').appendChild(span);

                responseMsg.error_msgs.forEach((error_msg) => {
                    let alert = document.createElement('div');
                    alert.classList.add('alert', 'alert-danger');
                    alert.setAttribute('role', 'alert');
                    alert.textContent = error_msg;
                    confirmTourneyModal.querySelector('.response-div').appendChild(alert);
                });

                bootstrap.Modal.getInstance(confirmTourneyModal).handleUpdate();
            }
        } catch (error) {
            let span = document.createElement('span');
            span.classList.add('text-danger');
            span.textContent = 'Error!';
            confirmTourneyModal.querySelector('.modal-title').appendChild(span);

            let alert = document.createElement('div');
            alert.classList.add('alert', 'alert-danger');
            alert.setAttribute('role', 'alert');
            alert.textContent = error;
            confirmTourneyModal.querySelector('.response-div').appendChild(alert);

            bootstrap.Modal.getInstance(confirmTourneyModal).handleUpdate();
        }
    });

    // Define what happens in case of error
    XHR.addEventListener('error', function (event) {
        let span = document.createElement('span');
        span.classList.add('text-danger');
        span.textContent = 'Error!';
        confirmTourneyModal.querySelector('.modal-title').appendChild(span);

        let alert = document.createElement('div');
        alert.classList.add('alert', 'alert-danger');
        alert.setAttribute('role', 'alert');
        alert.textContent = 'Oops! Something went wrong. Please try again.';
        confirmTourneyModal.querySelector('.response-div').appendChild(alert);

        bootstrap.Modal.getInstance(confirmTourneyModal).handleUpdate();
    });

    // Set up our request
    XHR.open('POST', '../../php-apis/get-tourney-details.php');

    // Send our FormData object; HTTP headers are set automatically
    XHR.send(FD);
});

confirmTourneyModal.addEventListener('hidden.bs.modal', function (event) {
    confirmTourneyModal.querySelector('.modal-title').innerHTML = '';
    confirmTourneyModal.querySelector('.response-div').innerHTML = '';
    confirmTourneyModal.querySelector('button.confirm-tourney').removeAttribute('data-tourney-id');
});

reopenTourneyModal.querySelector('form#reopen-tourney-form').addEventListener('submit', (event) => {
    event.preventDefault();

    const XHR = new XMLHttpRequest();

    // Bind the FormData object and the form element
    const FD = new FormData(reopenTourneyModal.querySelector('form#reopen-tourney-form'));

    reopenTourneyModal.querySelector('.response-div').innerHTML = '';
    reopenTourneyModal.querySelector('form#reopen-tourney-form > fieldset').disabled = true;
    reopenTourneyModal.querySelector('button.reopen-tourney').disabled = true;

    // Define what happens on successful data submission
    XHR.addEventListener("load", function (event) {
        try {
            let responseMsg = JSON.parse(event.target.responseText);

            if (responseMsg.status === 'success') {
                responseMsg.success_msgs.forEach((success_msg) => {
                    let alert = document.createElement('div');
                    alert.classList.add('alert', 'alert-success');
                    alert.setAttribute('role', 'alert');
                    alert.textContent = success_msg;
                    reopenTourneyModal.querySelector('.response-div').appendChild(alert);
                });

                let p = document.createElement('p');
                p.textContent = 'This page will reload in 3 seconds...';
                reopenTourneyModal.querySelector('.response-div').appendChild(p);

                setTimeout(function () {
                    location.reload();
                }, 3000);
            } else {
                responseMsg.error_msgs.forEach((error_msg) => {
                    let alert = document.createElement('div');
                    alert.classList.add('alert', 'alert-danger');
                    alert.setAttribute('role', 'alert');
                    alert.textContent = error_msg;
                    reopenTourneyModal.querySelector('.response-div').appendChild(alert);
                });

                reopenTourneyModal.querySelector('form#reopen-tourney-form > fieldset').disabled = false;
                reopenTourneyModal.querySelector('button.reopen-tourney').disabled = false;
            }
        } catch (error) {
            let alert = document.createElement('div');
            alert.classList.add('alert', 'alert-danger');
            alert.setAttribute('role', 'alert');
            alert.textContent = error;
            reopenTourneyModal.querySelector('.response-div').appendChild(alert);

            reopenTourneyModal.querySelector('form#reopen-tourney-form > fieldset').disabled = false;
            reopenTourneyModal.querySelector('button.reopen-tourney').disabled = false;
        }

        bootstrap.Modal.getInstance(reopenTourneyModal).handleUpdate();
    });

    // Define what happens in case of error
    XHR.addEventListener("error", function (event) {
        let alert = document.createElement('div');
        alert.classList.add('alert', 'alert-danger');
        alert.setAttribute('role', 'alert');
        alert.textContent = 'Oops! Something went wrong. Please try again.';
        reopenTourneyModal.querySelector('.response-div').appendChild(alert);

        bootstrap.Modal.getInstance(reopenTourneyModal).handleUpdate();

        reopenTourneyModal.querySelector('form#reopen-tourney-form > fieldset').disabled = false;
        reopenTourneyModal.querySelector('button.reopen-tourney').disabled = false;
    });

    // Set up our request
    XHR.open("POST", "../../php-apis/reopen-tournament.php");

    // The data sent is what the user provided in the form
    XHR.send(FD);
});

cancelTourneyModal.querySelector('button.cancel-tourney').addEventListener('click', () => {
    const XHR = new XMLHttpRequest();
    const FD = new FormData();

    // Push our data into our FormData object
    FD.append('tourney-id', cancelTourneyModal.querySelector('button.cancel-tourney').dataset.tourneyId);

    cancelTourneyModal.querySelector('.response-div').innerHTML = '';
    cancelTourneyModal.querySelector('button.cancel-tourney').disabled = true;

    // Define what happens on successful data submission
    XHR.addEventListener('load', function (event) {
        try {
            let responseMsg = JSON.parse(event.target.responseText);

            if (responseMsg.status === 'success') {
                responseMsg.success_msgs.forEach((success_msg) => {
                    let alert = document.createElement('div');
                    alert.classList.add('alert', 'alert-success');
                    alert.setAttribute('role', 'alert');
                    alert.textContent = success_msg;
                    cancelTourneyModal.querySelector('.response-div').appendChild(alert);
                });

                let p = document.createElement('p');
                p.textContent = 'This page will reload in 10 seconds...';
                cancelTourneyModal.querySelector('.response-div').appendChild(p);

                setTimeout(function () {
                    location.reload();
                }, 10000);
            } else {
                responseMsg.error_msgs.forEach((error_msg) => {
                    let alert = document.createElement('div');
                    alert.classList.add('alert', 'alert-danger');
                    alert.setAttribute('role', 'alert');
                    alert.textContent = error_msg;
                    cancelTourneyModal.querySelector('.response-div').appendChild(alert);
                });

                cancelTourneyModal.querySelector('button.cancel-tourney').disabled = false;
            }
        } catch (error) {
            let alert = document.createElement('div');
            alert.classList.add('alert', 'alert-danger');
            alert.setAttribute('role', 'alert');
            alert.textContent = error;
            cancelTourneyModal.querySelector('.response-div').appendChild(alert);

            cancelTourneyModal.querySelector('button.cancel-tourney').disabled = false;
        }

        bootstrap.Modal.getInstance(cancelTourneyModal).handleUpdate();
    });

    // Define what happens in case of error
    XHR.addEventListener('error', function (event) {
        let alert = document.createElement('div');
        alert.classList.add('alert', 'alert-danger');
        alert.setAttribute('role', 'alert');
        alert.textContent = 'Oops! Something went wrong. Please try again.';
        cancelTourneyModal.querySelector('.response-div').appendChild(alert);

        bootstrap.Modal.getInstance(cancelTourneyModal).handleUpdate();

        cancelTourneyModal.querySelector('button.cancel-tourney').disabled = false;
    });

    // Set up our request
    XHR.open('POST', '../../php-apis/cancel-tournament.php');

    // Send our FormData object; HTTP headers are set automatically
    XHR.send(FD);
});

cancelTourneyModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var tourneyId = button.getAttribute('data-bs-tourneyId')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.

    cancelTourneyModal.querySelector('.modal-title').innerHTML = '';
    cancelTourneyModal.querySelector('.response-div').innerHTML = '';
    cancelTourneyModal.querySelector('button.cancel-tourney').disabled = false;
    cancelTourneyModal.querySelector('button.cancel-tourney').removeAttribute('data-tourney-id');

    const XHR = new XMLHttpRequest();
    const FD = new FormData();

    // Push our data into our FormData object
    FD.append('tourney-id', tourneyId);

    // Define what happens on successful data submission
    XHR.addEventListener('load', function (event) {
        try {
            let responseMsg = JSON.parse(event.target.responseText);

            if (responseMsg.status === 'success') {
                let tourney_details = responseMsg.tourney_details;

                let gamePlusConsole = ((tourney_details.game === 'fifa_21') ? (tourney_details.game.replaceAll("_", " ").toUpperCase()) : (tourney_details.game.replaceAll("_", " ").toUpperCase())) + ' - ' + ((tourney_details.console === 'ps4' || tourney_details.console === 'pc') ? (tourney_details.console.toUpperCase()) : (tourney_details.console.toUpperCase()));
                cancelTourneyModal.querySelector('.modal-title').textContent = 'Cancel Tournament # ' + tourney_details.tournament_id + ' (' + gamePlusConsole + ')';

                cancelTourneyModal.querySelector('button.cancel-tourney').dataset.tourneyId = tourney_details.tournament_id;
            } else {
                let span = document.createElement('span');
                span.classList.add('text-danger');
                span.textContent = 'Error!';
                cancelTourneyModal.querySelector('.modal-title').appendChild(span);

                responseMsg.error_msgs.forEach((error_msg) => {
                    let alert = document.createElement('div');
                    alert.classList.add('alert', 'alert-danger');
                    alert.setAttribute('role', 'alert');
                    alert.textContent = error_msg;
                    cancelTourneyModal.querySelector('.response-div').appendChild(alert);
                });

                bootstrap.Modal.getInstance(cancelTourneyModal).handleUpdate();

                cancelTourneyModal.querySelector('button.cancel-tourney').disabled = true;
            }
        } catch (error) {
            let span = document.createElement('span');
            span.classList.add('text-danger');
            span.textContent = 'Error!';
            cancelTourneyModal.querySelector('.modal-title').appendChild(span);

            let alert = document.createElement('div');
            alert.classList.add('alert', 'alert-danger');
            alert.setAttribute('role', 'alert');
            alert.textContent = error;
            cancelTourneyModal.querySelector('.response-div').appendChild(alert);

            bootstrap.Modal.getInstance(cancelTourneyModal).handleUpdate();

            cancelTourneyModal.querySelector('button.cancel-tourney').disabled = true;
        }
    });

    // Define what happens in case of error
    XHR.addEventListener('error', function (event) {
        let span = document.createElement('span');
        span.classList.add('text-danger');
        span.textContent = 'Error!';
        cancelTourneyModal.querySelector('.modal-title').appendChild(span);

        let alert = document.createElement('div');
        alert.classList.add('alert', 'alert-danger');
        alert.setAttribute('role', 'alert');
        alert.textContent = 'Oops! Something went wrong. Please try again.';
        cancelTourneyModal.querySelector('.response-div').appendChild(alert);

        bootstrap.Modal.getInstance(cancelTourneyModal).handleUpdate();

        cancelTourneyModal.querySelector('button.cancel-tourney').disabled = true;
    });

    // Set up our request
    XHR.open('POST', '../../php-apis/get-tourney-details.php');

    // Send our FormData object; HTTP headers are set automatically
    XHR.send(FD);
});

cancelTourneyModal.addEventListener('hidden.bs.modal', function (event) {
    cancelTourneyModal.querySelector('.modal-title').innerHTML = '';
    cancelTourneyModal.querySelector('.response-div').innerHTML = '';
    cancelTourneyModal.querySelector('button.cancel-tourney').disabled = false;
    cancelTourneyModal.querySelector('button.cancel-tourney').removeAttribute('data-tourney-id');
});

reopenTourneyModal.addEventListener('shown.bs.modal', function (event) {
    reopenTourneyModal.querySelector('form#reopen-tourney-form input[name="tourney-reopen-start-date"]').focus();
});

reopenTourneyModal.addEventListener('show.bs.modal', function (event) {
    let today = new Date();
    reopenTourneyModal.querySelector('form#reopen-tourney-form input[name="tourney-reopen-start-date"]').setAttribute('min', new Date(today.setDate(today.getDate() + 1)).toISOString().slice(0, 10));

    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var tourneyId = button.getAttribute('data-bs-tourneyId')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.

    reopenTourneyModal.querySelector('.modal-title').innerHTML = '';
    reopenTourneyModal.querySelector('.response-div').innerHTML = '';
    reopenTourneyModal.querySelector('button.reopen-tourney').disabled = false;
    reopenTourneyModal.querySelector('input[name="tourney-id"]').removeAttribute('value');
    reopenTourneyModal.querySelector('form#reopen-tourney-form').reset();

    const XHR = new XMLHttpRequest();
    const FD = new FormData();

    // Push our data into our FormData object
    FD.append('tourney-id', tourneyId);

    // Define what happens on successful data submission
    XHR.addEventListener('load', function (event) {
        try {
            let responseMsg = JSON.parse(event.target.responseText);

            if (responseMsg.status === 'success') {
                let tourney_details = responseMsg.tourney_details;

                let gamePlusConsole = ((tourney_details.game === 'fifa_21') ? (tourney_details.game.replaceAll("_", " ").toUpperCase()) : (tourney_details.game.replaceAll("_", " ").toUpperCase())) + ' - ' + ((tourney_details.console === 'ps4' || tourney_details.console === 'pc') ? (tourney_details.console.toUpperCase()) : (tourney_details.console.toUpperCase()));
                reopenTourneyModal.querySelector('.modal-title').textContent = 'Re Open Tournament # ' + tourney_details.tournament_id + ' (' + gamePlusConsole + ')';

                reopenTourneyModal.querySelector('input[name="tourney-id"]').setAttribute('value', tourney_details.tournament_id);
            } else {
                let span = document.createElement('span');
                span.classList.add('text-danger');
                span.textContent = 'Error!';
                reopenTourneyModal.querySelector('.modal-title').appendChild(span);

                responseMsg.error_msgs.forEach((error_msg) => {
                    let alert = document.createElement('div');
                    alert.classList.add('alert', 'alert-danger');
                    alert.setAttribute('role', 'alert');
                    alert.textContent = error_msg;
                    reopenTourneyModal.querySelector('.response-div').appendChild(alert);
                });

                bootstrap.Modal.getInstance(reopenTourneyModal).handleUpdate();

                reopenTourneyModal.querySelector('button.reopen-tourney').disabled = true;
            }
        } catch (error) {
            let span = document.createElement('span');
            span.classList.add('text-danger');
            span.textContent = 'Error!';
            reopenTourneyModal.querySelector('.modal-title').appendChild(span);

            let alert = document.createElement('div');
            alert.classList.add('alert', 'alert-danger');
            alert.setAttribute('role', 'alert');
            alert.textContent = error;
            reopenTourneyModal.querySelector('.response-div').appendChild(alert);

            bootstrap.Modal.getInstance(reopenTourneyModal).handleUpdate();

            reopenTourneyModal.querySelector('button.reopen-tourney').disabled = true;
        }
    });

    // Define what happens in case of error
    XHR.addEventListener('error', function (event) {
        let span = document.createElement('span');
        span.classList.add('text-danger');
        span.textContent = 'Error!';
        reopenTourneyModal.querySelector('.modal-title').appendChild(span);

        let alert = document.createElement('div');
        alert.classList.add('alert', 'alert-danger');
        alert.setAttribute('role', 'alert');
        alert.textContent = 'Oops! Something went wrong. Please try again.';
        reopenTourneyModal.querySelector('.response-div').appendChild(alert);

        bootstrap.Modal.getInstance(reopenTourneyModal).handleUpdate();

        reopenTourneyModal.querySelector('button.reopen-tourney').disabled = true;
    });

    // Set up our request
    XHR.open('POST', '../../php-apis/get-tourney-details.php');

    // Send our FormData object; HTTP headers are set automatically
    XHR.send(FD);
});

reopenTourneyModal.addEventListener('hidden.bs.modal', function (event) {
    reopenTourneyModal.querySelector('.modal-title').innerHTML = '';
    reopenTourneyModal.querySelector('.response-div').innerHTML = '';
    reopenTourneyModal.querySelector('button.reopen-tourney').disabled = false;
    reopenTourneyModal.querySelector('input[name="tourney-id"]').removeAttribute('value');
    reopenTourneyModal.querySelector('form#reopen-tourney-form').reset();
});

tourneyPlayersModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    var tourneyId = button.getAttribute('data-bs-tourneyId');
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //

    const XHR = new XMLHttpRequest();
    const FD = new FormData();

    // Push our data into our FormData object
    FD.append('tourney-id', tourneyId);

    // Define what happens on successful data submission
    XHR.addEventListener('load', function (event) {
        let tourneyPlayersModalTitle = tourneyPlayersModal.querySelector('.modal-title');
        tourneyPlayersModalTitle.innerHTML = '';
        let tourneyPlayersTbody = tourneyPlayersModal.querySelector('.modal-body tbody');
        tourneyPlayersTbody.innerHTML = '';

        if (JSON.parse(event.target.responseText).status === 'success') {
            let response_msg = JSON.parse(event.target.responseText);
            let tourney_details = response_msg.tourney_details;

            let gameConsole = ((tourney_details.game === 'fifa_21') ? (tourney_details.game.replaceAll("_", " ").toUpperCase()) : (tourney_details.game.replaceAll("_", " ").toUpperCase())) + ' - ' + ((tourney_details.console === 'ps4' || tourney_details.console === 'pc') ? (tourney_details.console.toUpperCase()) : (tourney_details.console.toUpperCase()));

            tourneyPlayersModalTitle.textContent = 'Tournament # ' + tourney_details.tournament_id + ' (' + gameConsole + ')';

            tourney_details.tourney_players.forEach((tourney_player, index) => {
                let tr = document.createElement('tr');

                let th = document.createElement('th');
                th.setAttribute('scope', 'row');
                th.textContent = (index + 1);
                tr.appendChild(th);

                let td2 = document.createElement('td');
                td2.textContent = tourney_player.username.toUpperCase();
                if (tourney_details.tournament_by === tourney_player.player_id) {
                    let span = document.createElement('span');
                    span.classList.add('badge', 'bg-secondary', 'ms-2');
                    span.textContent = 'Owner';
                    td2.appendChild(span);
                } else {
                }
                tr.appendChild(td2);

                let td3 = document.createElement('td');
                td3.textContent = tourney_player.skill_level.toUpperCase();
                tr.appendChild(td3);

                let td4 = document.createElement('td');
                td4.textContent = tourney_player.skill_points;
                tr.appendChild(td4);

                let td5 = document.createElement('td');
                td5.textContent = tourney_player.enter_timestamp;
                tr.appendChild(td5);

                tourneyPlayersTbody.appendChild(tr);
            });
        } else {
            let errorSpan = document.createElement('span');
            errorSpan.classList.add('text-danger');
            errorSpan.textContent = 'Error!';

            tourneyPlayersModalTitle.appendChild(errorSpan);

            let response_msg = JSON.parse(event.target.responseText);

            response_msg.error_msgs.forEach((error_msg) => {
                let tr = document.createElement('tr');
                let td = document.createElement('td');
                td.setAttribute('colSpan', 5);
                td.classList.add('text-center');
                td.classList.add('text-danger');
                td.textContent = error_msg;

                tr.appendChild(td);
                tourneyPlayersTbody.appendChild(tr);
            });
        }
    });

    // Define what happens in case of error
    XHR.addEventListener('error', function (event) {
        alert('Oops! Something went wrong.');
    });

    // Set up our request
    XHR.open('POST', '../../php-apis/get-tourney-details.php');

    // Send our FormData object; HTTP headers are set automatically
    XHR.send(FD);
});

createTourneyModal.addEventListener('shown.bs.modal', function (event) {
    let today = new Date();
    tourneyStartDate.setAttribute('min', new Date(today.setDate(today.getDate() + 1)).toISOString().slice(0, 10));
    tourneyGameSelect.focus();
});

createTourneyModal.addEventListener('hidden.bs.modal', function (event) {
    createTourneyForm.reset();
    createTourneyForm.classList.remove('was-validated');
});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'

    createTourneyForm.addEventListener('submit', function (event) {
        if (!createTourneyForm.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            event.preventDefault();
            event.stopPropagation();

            //Bind the FormData object and the form element
            const FD = new FormData(createTourneyForm);

            createTourneyFieldset.disabled = true;
            createTourneyButton.disabled = true;

            const XHR = new XMLHttpRequest();

            // Define what happens on successful data submission
            XHR.addEventListener("load", function (event) {
                let responseMsg = JSON.parse(event.target.responseText);
                alert(responseMsg.description);

                if (responseMsg.status.includes('success')) {
                    location.reload();
                } else {
                    createTourneyFieldset.disabled = false;
                    createTourneyButton.disabled = false;

                    createTourneyForm.classList.remove('was-validated');

                    tourneyGameSelect.focus();
                }
            });

            // Define what happens in case of error
            XHR.addEventListener("error", function (event) {
                alert('Oops! Something went wrong.');
                createTourneyFieldset.disabled = false;
                createTourneyButton.disabled = false;

                tourneyGameSelect.focus();
            });

            // Set up our request
            XHR.open("POST", "../../php-apis/create-tournament.php");

            // The data sent is what the user provided in the form
            XHR.send(FD);
        }

        createTourneyForm.classList.add('was-validated')
    }, false);
})()