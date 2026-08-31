(function () {
    'use strict';

    const form = document.getElementById('registerForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirm');
    const togglePasswordBtn = document.getElementById('togglePassword');
    const togglePasswordConfirmBtn = document.getElementById('togglePasswordConfirm');
    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const passwordConfirmError = document.getElementById('passwordConfirmError');

    let passwordVisible = false;
    let passwordConfirmVisible = false;

    function togglePasswordVisibility(input, btn, eyeOpen, eyeClosed) {
        const visible = input.type === 'text';
        input.type = visible ? 'password' : 'text';
        btn.setAttribute('aria-label', visible ? 'Mostrar senha' : 'Ocultar senha');
        btn.setAttribute('aria-pressed', !visible);
        eyeOpen.style.display = visible ? 'block' : 'none';
        eyeClosed.style.display = visible ? 'none' : 'block';
    }

    function setupToggle(btnId, inputId) {
        const btn = document.getElementById(btnId);
        const input = document.getElementById(inputId);
        const eyeOpen = btn.querySelector('.icon-eye-open');
        const eyeClosed = btn.querySelector('.icon-eye-closed');

        btn.addEventListener('click', function (e) {
            e.preventDefault();
            togglePasswordVisibility(input, btn, eyeOpen, eyeClosed);
        });

        btn.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                togglePasswordVisibility(input, btn, eyeOpen, eyeClosed);
            }
        });
    }

    setupToggle('togglePassword', 'password');
    setupToggle('togglePasswordConfirm', 'password_confirm');

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function showError(input, errorEl, message) {
        input.setAttribute('aria-invalid', 'true');
        errorEl.textContent = message;
    }

    function clearError(input, errorEl) {
        input.removeAttribute('aria-invalid');
        errorEl.textContent = '';
    }

    function validateField(input, errorEl, validator, message) {
        if (!validator(input.value)) {
            showError(input, errorEl, message);
            return false;
        }
        clearError(input, errorEl);
        return true;
    }

    nameInput.addEventListener('blur', function () {
        if (this.value && this.value.trim().length < 2) {
            showError(this, nameError, 'Digite seu nome completo');
        }
    });

    nameInput.addEventListener('input', function () {
        if (this.hasAttribute('aria-invalid') && this.value.trim().length >= 2) {
            clearError(this, nameError);
        }
    });

    emailInput.addEventListener('blur', function () {
        if (this.value) {
            validateField(this, emailError, validateEmail, 'Digite um e-mail válido');
        }
    });

    emailInput.addEventListener('input', function () {
        if (this.hasAttribute('aria-invalid')) {
            validateField(this, emailError, validateEmail, 'Digite um e-mail válido');
        }
    });

    passwordInput.addEventListener('blur', function () {
        if (this.value && this.value.length < 6) {
            showError(this, passwordError, 'A senha deve ter pelo menos 6 caracteres');
        }
    });

    passwordInput.addEventListener('input', function () {
        if (this.hasAttribute('aria-invalid')) {
            if (this.value.length >= 6) {
                clearError(this, passwordError);
            }
        }
        if (passwordConfirmInput.value) {
            validatePasswordMatch();
        }
    });

    passwordConfirmInput.addEventListener('blur', validatePasswordMatch);

    passwordConfirmInput.addEventListener('input', function () {
        if (this.hasAttribute('aria-invalid')) {
            validatePasswordMatch();
        }
    });

    function validatePasswordMatch() {
        if (passwordConfirmInput.value && passwordInput.value !== passwordConfirmInput.value) {
            showError(passwordConfirmInput, passwordConfirmError, 'As senhas não coincidem');
            return false;
        }
        clearError(passwordConfirmInput, passwordConfirmError);
        return true;
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const nameValid = validateField(nameInput, nameError, val => val.trim().length >= 2, 'Digite seu nome completo');
        const emailValid = validateField(emailInput, emailError, validateEmail, 'Digite um e-mail válido');
        const passwordValid = validateField(passwordInput, passwordError, val => val.length >= 6, 'A senha deve ter pelo menos 6 caracteres');
        const confirmValid = validatePasswordMatch();

        if (nameValid && emailValid && passwordValid && confirmValid) {
            console.log('Register form submitted (demo)');
            console.log('Name:', nameInput.value);
            console.log('Email:', emailInput.value);
            console.log('Password:', passwordInput.value);
        }
    });
})();