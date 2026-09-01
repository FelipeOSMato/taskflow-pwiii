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

    // Mostrar / ocultar senha
    function togglePasswordVisibility() {
        passwordVisible = !passwordVisible;

        passwordInput.type = passwordVisible ? 'text' : 'password';

        toggleBtn.setAttribute(
            'aria-label',
            passwordVisible ? 'Ocultar senha' : 'Mostrar senha'
        );

        toggleBtn.setAttribute(
            'aria-pressed',
            passwordVisible.toString()
        );

        eyeOpen.style.display = passwordVisible ? 'none' : 'block';
        eyeClosed.style.display = passwordVisible ? 'block' : 'none';
    }

    // Validação de e-mail
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

    // Validação do e-mail ao sair do campo
    emailInput.addEventListener('blur', function () {
        if (this.value) {
            validateField(
                this,
                emailError,
                validateEmail,
                'Digite um e-mail válido'
            );
        }
    });

    // Validação do e-mail enquanto digita
    emailInput.addEventListener('input', function () {
        if (this.hasAttribute('aria-invalid')) {
            validateField(
                this,
                emailError,
                validateEmail,
                'Digite um e-mail válido'
            );
        }
    });

    // Validação da senha
    passwordInput.addEventListener('blur', function () {
        if (this.value && this.value.length < 6) {
            showError(
                this,
                passwordError,
                'A senha deve ter pelo menos 6 caracteres'
            );
        }
    });

    passwordInput.addEventListener('input', function () {
        if (this.hasAttribute('aria-invalid')) {
            if (this.value.length >= 6) {
                clearError(this, passwordError);
            }
        }
    });

    // Botão mostrar/ocultar senha
    toggleBtn.addEventListener('click', function () {
        togglePasswordVisibility();
    });

    // Teclado no botão da senha
    toggleBtn.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            togglePasswordVisibility();
        }
    });

    // ENVIO DO FORMULÁRIO
    form.addEventListener('submit', function (e) {
        const emailValid = validateField(
            emailInput,
            emailError,
            validateEmail,
            'Digite um e-mail válido'
        );

        const passwordValid = validateField(
            passwordInput,
            passwordError,
            value => value.length >= 6,
            'A senha deve ter pelo menos 6 caracteres'
        );

        // Só impede o envio se houver erro.
        if (!emailValid || !passwordValid) {
            e.preventDefault();
        }

        // Se estiver tudo certo, NÃO usamos preventDefault().
        // O navegador envia o formulário normalmente para:
        // POST /login
    });

})();