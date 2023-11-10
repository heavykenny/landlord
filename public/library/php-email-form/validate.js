(function () {
    "use strict";

    let forms = document.querySelectorAll('.php-email-form');

    forms.forEach(function (e) {
        e.addEventListener('submit', function (event) {
            event.preventDefault();

            let thisForm = this;
            let action = thisForm.getAttribute('action');

            if (!action) {
                displayError(thisForm, 'The form action property is not set!');
                return;
            }

            thisForm.querySelector('.loading').classList.add('d-block');
            thisForm.querySelector('.error-message').classList.remove('d-block');
            thisForm.querySelector('.sent-message').classList.remove('d-block');

            let formData = new FormData(thisForm);
            submitForm(thisForm, action, formData);
        });
    });

    function submitForm(thisForm, action, formData) {
        fetch(action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Bearer': document.cookie.replace(/(?:(?:^|.*;\s*)token\s*\=\s*([^;]*).*$)|^.*$/, "$1")
            },
        })
            .then(response => {
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error(`${response.status} ${response.statusText} ${response.url}`);
                }
            })
            .then(data => {
                thisForm.querySelector('.loading').classList.remove('d-block');
                if (data.trim() === 'OK') {
                    thisForm.querySelector('.sent-message').classList.add('d-block');
                    thisForm.reset();
                } else {
                    throw new Error(data ? data : 'Form submission failed and no error message returned from: ' + action);
                }
            })
            .catch((error) => {
                let response = JSON.parse(error.message);

                if (!response.status) {
                    displayError(thisForm, response.message);
                } else {
                    if (response.token !== undefined) {
                        document.cookie = `token=${response.token}; path=/`;
                    }
                    displaySuccess(thisForm, response.message);
                    thisForm.reset();
                    redirectIfLoggedIn();
                }
            });
    }

    function logout() {
        document.cookie = 'token=; path=/';
        window.location.replace('/');
    }

    function displayError(thisForm, error) {
        thisForm.querySelector('.loading').classList.remove('d-block');
        thisForm.querySelector('.error-message').innerText = error;
        thisForm.querySelector('.error-message').classList.add('d-block');
    }

    function displaySuccess(thisForm, message) {
        thisForm.querySelector('.loading').classList.remove('d-block');
        thisForm.querySelector('.sent-message').innerText = message;
        thisForm.querySelector('.sent-message').classList.add('d-block');
    }

    function redirectIfLoggedIn() {
        if (document.cookie.replace(/(?:(?:^|.*;\s*)token\s*\=\s*([^;]*).*$)|^.*$/, "$1") !== '') {
            window.location.replace('index.php');
        }
    }
})();