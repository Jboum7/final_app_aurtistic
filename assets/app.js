import './styles/app.css';

import './styles/app.css';

document.addEventListener('DOMContentLoaded', function () {
    const settingsForm = document.querySelector('.settings-form');

    if (!settingsForm) {
        return;
    }

    const body = document.body;

    const fontSizeInputs = settingsForm.querySelectorAll('input[name="setting[fontsize]"]');
    const fontWeightInputs = settingsForm.querySelectorAll('input[name="setting[fontweight]"]');
    const fontStretchInputs = settingsForm.querySelectorAll('input[name="setting[fontstretch]"]');

    fontSizeInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            body.style.fontSize = input.value + 'rem';
        });
    });

    fontWeightInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            body.style.fontWeight = input.value;
        });
    });

    fontStretchInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            body.style.fontStretch = input.value + '%';
        });
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const settingsForm = document.querySelector('.settings-form');

    if (!settingsForm) {
        return;
    }

    const body = document.querySelector('body');
    const themeInputs = settingsForm.querySelectorAll('input[name="setting[theme]"]');

    themeInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            if (input.value === 'dark') {
                body.classList.add('theme-dark');
            } else {
                body.classList.remove('theme-dark');
            }
        });
    });
});
