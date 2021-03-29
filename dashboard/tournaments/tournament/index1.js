const challengeResultButtons = document.querySelectorAll('button.challenge-result');

challengeResultButtons.forEach((challengeResultButton) => {
    challengeResultButton.addEventListener('click', () => {
        if (window.confirm("Are You Ready To Declare Your Result ?\nThis Action Cannot Be Undone.\nPress (OK) to Declare Your Result Or Press (Cancel) To Return Back.")) {
            const XHR = new XMLHttpRequest();
            const FD = new FormData();

            // Push our data into our FormData object
            FD.append('challenge-id', challengeResultButton.dataset.challengeId);
            FD.append('claimed-result', challengeResultButton.dataset.result);

            // Define what happens on successful data submission
            XHR.addEventListener('load', function (event) {
                alert(JSON.parse(event.target.responseText).description);

                location.reload();
            });

            // Define what happens in case of error
            XHR.addEventListener('error', function (event) {
                alert('Oops! Something went wrong.');
            });

            // Set up our request
            XHR.open('POST', '../../../php-apis/claim-challenge-result.php');

            // Send our FormData object; HTTP headers are set automatically
            XHR.send(FD);
        } else {
        }
    });
});