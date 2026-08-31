(function () {
    'use strict';

    const form = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const toggleBtn = document.getElementById('togglePassword');
    const eyeOpen = toggleBtn.querySelector('.icon-eye-open');
    const eyeClosed = toggleBtn.querySelector('.icon-eye-closed');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

    let passwordVisible = false;

    function togglePasswordVisibility() {
        passwordVisible = !passwordVisible;
        passwordInput.type = passwordVisible ? 'text' : 'password';
        toggleBtn.setAttribute('aria-label', passwordVisible ? 'Ocultar senha' : 'Mostrar senha');
        toggleBtn.setAttribute('aria-pressed', passwordVisible);
        eyeOpen.style.display = passwordVisible ? 'none' : 'block';
        eyeClosed.style.display = passwordVisible ? 'block' : 'none';
    }

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
    });

    toggleBtn.addEventListener('click', function (e) {
        e.preventDefault();
        togglePasswordVisibility();
    });

    toggleBtn.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            togglePasswordVisibility();
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const emailValid = validateField(emailInput, emailError, validateEmail, 'Digite um e-mail válido');
        const passwordValid = validateField(passwordInput, passwordError, val => val.length >= 6, 'A senha deve ter pelo menos 6 caracteres');

        if (emailValid && passwordValid) {
            console.log('Login form submitted (demo)');
            console.log('Email:', emailInput.value);
            console.log('Password:', passwordInput.value);
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
            const activeElement = document.activeElement;
            if (activeElement === emailInput || activeElement === passwordInput || activeElement === toggleBtn) {
                return;
            }
        }
    });
})();