const acceptChallengeButtons = document.querySelectorAll('.accept-challenge-button');
const tourneyPlayersModal = document.getElementById('tourney-players-modal');
const enterTourneyModal = document.getElementById('enter-tourney-modal');
const enterTourneyButton = enterTourneyModal.querySelector('button.enter-tourney');

enterTourneyButton.addEventListener('click', () => {
    const XHR = new XMLHttpRequest();
    const FD = new FormData();

    // Push our data into our FormData object
    FD.append('tourney-id', enterTourneyButton.dataset.tourneyId);

    enterTourneyModal.querySelector('.response-div').innerHTML = '';
    enterTourneyButton.disabled = true;

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

                    enterTourneyModal.querySelector('.response-div').appendChild(alert);
                });

                let p = document.createElement('p');
                p.textContent = 'You will be redirect to the Tournaments page in 5 seconds...';
                enterTourneyModal.querySelector('.response-div').appendChild(p);

                setTimeout(function () {
                    window.location.href = '../tournaments';
                }, 5000);
            } else {
                let reload = false;

                responseMsg.error_msgs.forEach((error_msg) => {
                    let alert = document.createElement('div');
                    alert.classList.add('alert', 'alert-danger');
                    alert.setAttribute('role', 'alert');
                    alert.textContent = error_msg;

                    enterTourneyModal.querySelector('.response-div').appendChild(alert);

                    reload = ((error_msg.includes('Error: Tournament has been reset!')) ? (true) : (false));
                });

                if (reload) {
                    let p = document.createElement('p');
                    p.textContent = 'This page will reload in 5 seconds...';
                    enterTourneyModal.querySelector('.response-div').appendChild(p);

                    setTimeout(function () {
                        location.reload();
                    }, 5000);
                } else {
                }
            }

            bootstrap.Modal.getInstance(enterTourneyModal).handleUpdate();

            enterTourneyButton.disabled = false;
        } catch (error) {
            let alert = document.createElement('div');
            alert.classList.add('alert', 'alert-danger');
            alert.setAttribute('role', 'alert');
            alert.textContent = error;

            enterTourneyModal.querySelector('.response-div').appendChild(alert);
            bootstrap.Modal.getInstance(enterTourneyModal).handleUpdate();

            enterTourneyButton.disabled = false;
        }
    });

    // Define what happens in case of error
    XHR.addEventListener('error', function (event) {
        let alert = document.createElement('div');
        alert.classList.add('alert', 'alert-danger');
        alert.setAttribute('role', 'alert');
        alert.textContent = 'Oops! Something went wrong. Please try again.';

        enterTourneyModal.querySelector('.response-div').appendChild(alert);
        bootstrap.Modal.getInstance(enterTourneyModal).handleUpdate();

        enterTourneyButton.disabled = false;
    });

    // Set up our request
    XHR.open('POST', '../../php-apis/enter-tournament.php');

    // Send our FormData object; HTTP headers are set automatically
    XHR.send(FD);
});

enterTourneyModal.addEventListener('hide.bs.modal', function (event) {
    enterTourneyButton.removeAttribute('data-tourney-id');
    enterTourneyButton.disabled = false;
});

enterTourneyModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    let button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    let tourneyId = button.getAttribute('data-bs-tourneyId');
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.

    let modalTitle = enterTourneyModal.querySelector('.modal-title');
    let modalBody = enterTourneyModal.querySelector('.modal-body');

    modalTitle.innerHTML = '';
    modalBody.innerHTML = '';

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

                let gameConsole = ((tourney_details.game === 'fifa_21') ? (tourney_details.game.replaceAll("_", " ").toUpperCase()) : (tourney_details.game.replaceAll("_", " ").toUpperCase())) + ' - ' + ((tourney_details.console === 'ps4' || tourney_details.console === 'pc') ? (tourney_details.console.toUpperCase()) : (tourney_details.console.toUpperCase()));
                modalTitle.textContent = 'Enter Tournament # ' + tourney_details.tournament_id + ' (' + gameConsole + ')';

                let p = document.createElement('p');
                p.textContent = 'Are you sure you want to enter in this Tournament ?';
                modalBody.appendChild(p);

                let ul = document.createElement('ul');

                let li1 = document.createElement('li');
                li1.textContent = 'Entering in this Tournament will deduct the Tournament amount from your Balance.';
                ul.appendChild(li1);

                let li2 = document.createElement('li');
                li2.textContent = 'You need to have atleast $' + tourney_details.amount + ' in your Balance.';
                ul.appendChild(li2);

                modalBody.appendChild(ul);

                let p2 = document.createElement('p');
                p2.textContent = 'Press (Enter Tournament) to continue.';
                modalBody.appendChild(p2);

                let responseDiv = document.createElement('div');
                responseDiv.classList.add('response-div');
                modalBody.appendChild(responseDiv);

                enterTourneyButton.dataset.tourneyId = tourney_details.tournament_id;
            } else {
                let span = document.createElement('span');
                span.classList.add('text-danger');
                span.textContent = 'Error!';
                modalTitle.appendChild(span);

                responseMsg.error_msgs.forEach((error_msg) => {
                    let p = document.createElement('p');
                    p.classList.add('text-danger');
                    p.textContent = error_msg;
                    modalBody.appendChild(p);
                });
            }
        } catch (e) {
            console.log(e);
        }
    });

    // Define what happens in case of error
    XHR.addEventListener('error', function (event) {
        let span = document.createElement('span');
        span.classList.add('text-danger');
        span.textContent = 'Error!';
        modalTitle.appendChild(span);

        let span2 = document.createElement('span');
        span2.classList.add('text-center', 'text-danger');
        span2.textContent = 'Oops! Something went wrong. Please try again!';
        modalBody.appendChild(span2);
    });

    // Set up our request
    XHR.open('POST', '../../php-apis/get-tourney-details.php');

    // Send our FormData object; HTTP headers are set automatically
    XHR.send(FD);

});

tourneyPlayersModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    let button = event.relatedTarget;
    // Extract info from data-bs-* attributes
    let tourneyId = button.getAttribute('data-bs-tourneyId');
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

            tourneyPlayersModalTitle.textContent = 'Tournament # ' + tourney_details.tournament_id + ' (' + gameConsole + ') Players';

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

acceptChallengeButtons.forEach(function (acceptChallengeButton, currentIndex, listObj) {
    acceptChallengeButton.addEventListener('click', () => {
        if (window.confirm("Are you sure you want to Accept this Challenge ?\nAccepting this Challenge will DEDUCT the Challenge amount from your Balance.\nPress (OK) to Accept or (Cancel) to return back.")) {
            const XHR = new XMLHttpRequest();
            const FD = new FormData();

            // Push our data into our FormData object
            FD.append('challenge-id', acceptChallengeButton.dataset.challengeId);

            acceptChallengeButton.disabled = true;

            // Define what happens on successful data submission
            XHR.addEventListener('load', function (event) {
                alert(JSON.parse(event.target.responseText).description);

                if (JSON.parse(event.target.responseText).status === 'success') {
                    window.location.href = "../challenges";
                } else {
                    location.reload();
                }
            });

            // Define what happens in case of error
            XHR.addEventListener('error', function (event) {
                alert('Oops! Something went wrong.');

                acceptChallengeButton.disabled = false;
            });

            // Set up our request
            XHR.open('POST', '../../php-apis/accept-challenge.php');

            // Send our FormData object; HTTP headers are set automatically
            XHR.send(FD);
        } else {
        }
    });
});