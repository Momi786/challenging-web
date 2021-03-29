const notifButtons = document.querySelectorAll('button.notif_button');

notifButtons.forEach(function (notifButton, currentIndex) {
    notifButton.addEventListener('click', () => {
        const XHR = new XMLHttpRequest();
        const FD = new FormData();

        // Push our data into our FormData object
        FD.append('notif_id', notifButton.dataset.notif_id);

        notifButton.disabled = true;

        // Define what happens on successful data submission
        XHR.addEventListener('load', function (event) {
            if (JSON.parse(event.target.responseText).status === 'success') {
                if (notifButton.querySelector('i').classList.contains('bi-envelope')) {
                    notifButton.querySelector('i').classList.remove('bi-envelope');
                    notifButton.querySelector('i').classList.add('bi-envelope-open');
                } else {
                }
            } else {

            }

            notifButton.disabled = false;
        });

        // Define what happens in case of error
        XHR.addEventListener('error', function (event) {
            alert('Oops! Something went wrong.');

            notifButton.disabled = false;
        });

        // Set up our request
        XHR.open('POST', '../../php-apis/mark-notif-read.php');

        // Send our FormData object; HTTP headers are set automatically
        XHR.send(FD);
    });
});