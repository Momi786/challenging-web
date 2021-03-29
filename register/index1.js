const registerForm = document.querySelector('form');
const registerFieldset = document.querySelector('#register-fieldset');

registerForm.addEventListener('submit', (event) => {
    event.preventDefault();

    // Bind the FormData object and the form element
    const FD = new FormData(registerForm);

    registerFieldset.disabled = true;

    const XHR = new XMLHttpRequest();

    // Define what happens on successful data submission
    XHR.addEventListener("load", function (event) {
        let responseMsg = JSON.parse(event.target.responseText);

        alert(responseMsg.description);

        if (responseMsg.status.includes('success')) {
            registerForm.reset();
            window.location.href = "../dashboard";
        } else {
        }

        registerFieldset.disabled = false;
    });

    // Define what happens in case of error
    XHR.addEventListener("error", function (event) {
        alert('Oops! Something went wrong.');
        registerFieldset.disabled = false;
    });

    // Set up our request
    XHR.open("POST", "../php-apis/register.php");

    // The data sent is what the user provided in the form
    XHR.send(FD);
});