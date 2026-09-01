(function () {
    'use strict';

    const form = document.getElementById('registerForm');

    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirm');

    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const passwordConfirmError = document.getElementById('passwordConfirmError');

    // =========================
    // Mostrar / esconder senha
    // =========================

    function setupToggle(btnId, inputId) {
        const btn = document.getElementById(btnId);
        const input = document.getElementById(inputId);

        if (!btn || !input) return;

        const eyeOpen = btn.querySelector('.icon-eye-open');
        const eyeClosed = btn.querySelector('.icon-eye-closed');

        btn.addEventListener('click', function () {
            const isPassword = input.type === 'password';

            input.type = isPassword ? 'text' : 'password';

            btn.setAttribute(
                'aria-label',
                isPassword ? 'Ocultar senha' : 'Mostrar senha'
            );

            btn.setAttribute('aria-pressed', isPassword);

            if (eyeOpen && eyeClosed) {
                eyeOpen.style.display = isPassword ? 'none' : 'block';
                eyeClosed.style.display = isPassword ? 'block' : 'none';
            }
        });
    }

    setupToggle('togglePassword', 'password');
    setupToggle('togglePasswordConfirm', 'password_confirm');


    // =========================
    // Validação de e-mail
    // =========================

    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }


    // =========================
    // Mostrar erro
    // =========================

    function showError(input, errorElement, message) {
        input.setAttribute('aria-invalid', 'true');

        if (errorElement) {
            errorElement.textContent = message;
        }
    }


    // =========================
    // Limpar erro
    // =========================

    function clearError(input, errorElement) {
        input.removeAttribute('aria-invalid');

        if (errorElement) {
            errorElement.textContent = '';
        }
    }


    // =========================
    // Validar campo
    // =========================

    function validateField(input, errorElement, validator, message) {
        if (!validator(input.value)) {
            showError(input, errorElement, message);
            return false;
        }

        clearError(input, errorElement);
        return true;
    }


    // =========================
    // Validar nome
    // =========================

    nameInput.addEventListener('blur', function () {
        if (!this.value.trim()) {
            showError(
                this,
                nameError,
                'Digite seu nome'
            );
        } else if (this.value.trim().length < 2) {
            showError(
                this,
                nameError,
                'Digite um nome válido'
            );
        }
    });

    nameInput.addEventListener('input', function () {
        if (this.value.trim().length >= 2) {
            clearError(this, nameError);
        }
    });


    // =========================
    // Validar e-mail
    // =========================

    emailInput.addEventListener('blur', function () {
        if (!this.value) {
            showError(
                this,
                emailError,
                'Digite seu e-mail'
            );
        } else if (!validateEmail(this.value)) {
            showError(
                this,
                emailError,
                'Digite um e-mail válido'
            );
        }
    });

    emailInput.addEventListener('input', function () {
        if (validateEmail(this.value)) {
            clearError(this, emailError);
        }
    });


    // =========================
    // Validar senha
    // =========================

    passwordInput.addEventListener('blur', function () {
        if (!this.value) {
            showError(
                this,
                passwordError,
                'Digite uma senha'
            );
        } else if (this.value.length < 6) {
            showError(
                this,
                passwordError,
                'A senha deve ter pelo menos 6 caracteres'
            );
        }
    });

    passwordInput.addEventListener('input', function () {
        if (this.value.length >= 6) {
            clearError(this, passwordError);
        }

        if (passwordConfirmInput.value) {
            validatePasswordMatch();
        }
    });


    // =========================
    // Confirmar senha
    // =========================

    function validatePasswordMatch() {
        if (!passwordConfirmInput.value) {
            showError(
                passwordConfirmInput,
                passwordConfirmError,
                'Confirme sua senha'
            );

            return false;
        }

        if (passwordInput.value !== passwordConfirmInput.value) {
            showError(
                passwordConfirmInput,
                passwordConfirmError,
                'As senhas não coincidem'
            );

            return false;
        }

        clearError(
            passwordConfirmInput,
            passwordConfirmError
        );

        return true;
    }

    passwordConfirmInput.addEventListener(
        'blur',
        validatePasswordMatch
    );

    passwordConfirmInput.addEventListener(
        'input',
        validatePasswordMatch
    );


    // =========================
    // ENVIO DO FORMULÁRIO
    // =========================

    form.addEventListener('submit', function (e) {

        const nameValid = validateField(
            nameInput,
            nameError,
            value => value.trim().length >= 2,
            'Digite seu nome completo'
        );

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

        const confirmValid = validatePasswordMatch();


        // Se tiver algum erro,
        // impede o formulário de ser enviado.
        if (
            !nameValid ||
            !emailValid ||
            !passwordValid ||
            !confirmValid
        ) {
            e.preventDefault();
            return;
        }

        /*
         * IMPORTANTE:
         *
         * Não coloque e.preventDefault() aqui.
         *
         * Se os dados estiverem corretos,
         * o formulário será enviado normalmente
         * para o Laravel.
         */

    });

})();