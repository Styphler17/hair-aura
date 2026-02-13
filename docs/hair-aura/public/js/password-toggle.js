(function () {
    'use strict';

    const EYE_ICON = '<i class="fa-solid fa-eye" aria-hidden="true"></i>';
    const EYE_SLASH_ICON = '<i class="fa-solid fa-eye-slash" aria-hidden="true"></i>';

    function createToggleButton(input) {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'password-toggle-btn';
        button.setAttribute('aria-label', 'Show password');
        button.setAttribute('aria-pressed', 'false');
        button.innerHTML = EYE_ICON;

        button.addEventListener('click', function () {
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';

            button.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
            button.setAttribute('aria-pressed', isPassword ? 'true' : 'false');
            button.innerHTML = isPassword ? EYE_SLASH_ICON : EYE_ICON;
        });

        return button;
    }

    function wrapPasswordInput(input) {
        if (input.dataset.passwordToggleReady === '1') {
            return;
        }

        const parent = input.parentElement;
        if (!parent) {
            return;
        }

        const wrapper = document.createElement('div');
        wrapper.className = 'password-toggle-wrapper';

        parent.insertBefore(wrapper, input);
        wrapper.appendChild(input);

        input.classList.add('password-toggle-input');
        wrapper.appendChild(createToggleButton(input));
        input.dataset.passwordToggleReady = '1';
    }

    function initPasswordToggle() {
        const passwordInputs = document.querySelectorAll('input[type="password"]');
        passwordInputs.forEach(wrapPasswordInput);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initPasswordToggle);
    } else {
        initPasswordToggle();
    }
})();