const loginForm = document.querySelector('form');
const loginFieldset = document.querySelector('#login-fieldset');

loginForm.addEventListener('submit', (event) => {
    event.preventDefault();

    // Bind the FormData object and the form element
    const FD = new FormData(loginForm);

    loginFieldset.disabled = true;

    const XHR = new XMLHttpRequest();

    // Define what happens on successful data submission
    XHR.addEventListener("load", function (event) {
        let responseMsg = JSON.parse(event.target.responseText);

        if (responseMsg.status.includes('success')) {
            loginForm.reset();
            window.location.href = "../dashboard";
        } else {
            alert(responseMsg.description);
        }

        loginFieldset.disabled = false;
    });

    // Define what happens in case of error
    XHR.addEventListener("error", function (event) {
        alert('Oops! Something went wrong.');
        loginFieldset.disabled = false;
    });

    // Set up our request
    XHR.open("POST", "../php-apis/login.php");

    // The data sent is what the user provided in the form
    XHR.send(FD);
});