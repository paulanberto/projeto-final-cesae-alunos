document.addEventListener('DOMContentLoaded', function() {
    // Detecta qual página estamos
    const pageTitle = document.querySelector('h2.mb-3.p-5.mt-5.fonteBold').textContent.trim();
    const isLoginPage = pageTitle === 'Login';
    const isPasswordResetPage = pageTitle.includes('Redefinir');
    const form = document.querySelector('form');
    
    // Função para mostrar erro
    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        field.classList.add('is-invalid');
        
        // Remover alerta existente se houver
        const existingAlert = field.nextElementSibling;
        if (existingAlert && existingAlert.classList.contains('alert')) {
            existingAlert.remove();
        }
        
        // Criar novo alerta
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger';
        errorDiv.textContent = message;
        
        // Inserir após o campo
        field.parentNode.insertBefore(errorDiv, field.nextSibling);
        
        return false;
    }
    
    // Função para limpar erro
    function clearError(fieldId) {
        const field = document.getElementById(fieldId);
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
        
        // Remover alerta se existir
        const nextElement = field.nextElementSibling;
        if (nextElement && nextElement.classList.contains('alert')) {
            nextElement.remove();
        }
        
        return true;
    }
    
    // Validar email (deve terminar com @msft.cesae.pt)
    function validateEmail() {
        const emailField = document.getElementById('email');
        const email = emailField.value.trim();
        
        const emailPattern = /@msft\.cesae\.pt$/;
        if (!emailPattern.test(email)) {
            return showError('email', 'O email deve terminar com @msft.cesae.pt');
        }
        
        return clearError('email');
    }
    
    // Validar senha (mínimo 8 caracteres, 1 letra, 1 número, 1 símbolo)
    function validatePassword() {
        const passwordField = document.getElementById('password');
        const password = passwordField.value;
        
        if (password.length < 8) {
            return showError('password', 'A senha deve ter pelo menos 8 caracteres');
        }
        
        const letterPattern = /[A-Za-z]/;
        const numberPattern = /[0-9]/;
        const symbolPattern = /[^A-Za-z0-9]/;
        
        if (!letterPattern.test(password)) {
            return showError('password', 'A senha deve conter pelo menos uma letra');
        }
        
        if (!numberPattern.test(password)) {
            return showError('password', 'A senha deve conter pelo menos um número');
        }
        
        if (!symbolPattern.test(password)) {
            return showError('password', 'A senha deve conter pelo menos um símbolo');
        }
        
        return clearError('password');
    }
    
    // Adicionando validações específicas para página de registro
    if (!isLoginPage) {
        // Validar nome (mínimo 3 caracteres)
        function validateName() {
            const nameField = document.getElementById('name');
            const name = nameField.value.trim();
            
            if (name.length < 3) {
                return showError('name', 'O nome deve ter pelo menos 3 caracteres');
            }
            
            return clearError('name');
        }
        
        // Validar confirmação de email
        function validateEmailConfirmation() {
            const emailField = document.getElementById('email');
            const emailConfirmationField = document.getElementById('email_confirmation');
            const email = emailField.value.trim();
            const emailConfirmation = emailConfirmationField.value.trim();
            
            if (email !== emailConfirmation) {
                return showError('email_confirmation', 'Os emails não coincidem');
            }
            
            return clearError('email_confirmation');
        }
        
        // Validar confirmação de senha
        function validatePasswordConfirmation() {
            const passwordField = document.getElementById('password');
            const passwordConfirmationField = document.getElementById('password_confirmation');
            const password = passwordField.value;
            const passwordConfirmation = passwordConfirmationField.value;
            
            if (password !== passwordConfirmation) {
                return showError('password_confirmation', 'As senhas não coincidem');
            }
            
            return clearError('password_confirmation');
        }
        
        // Validar termos
        function validateTermos() {
            const termosField = document.getElementById('termos');
            
            if (!termosField.checked) {
                return showError('termos', 'Você deve aceitar os termos e condições');
            }
            
            return clearError('termos');
        }
        
        // Validar curso
        function validateCurso() {
            const cursoField = document.getElementById('curso_id');
            
            if (!cursoField.value) {
                return showError('curso_id', 'Por favor, selecione um curso');
            }
            
            return clearError('curso_id');
        }
        
        // Adicionar eventos para campos da página de registro
        document.getElementById('name').addEventListener('blur', validateName);
        document.getElementById('email_confirmation').addEventListener('blur', validateEmailConfirmation);
        document.getElementById('password_confirmation').addEventListener('blur', validatePasswordConfirmation);
        
        // Verificar se os elementos existem antes de adicionar event listeners
        if (document.getElementById('termos')) {
            document.getElementById('termos').addEventListener('change', validateTermos);
        }
        
        if (document.getElementById('curso_id')) {
            document.getElementById('curso_id').addEventListener('change', validateCurso);
        }
    }
    
    // Adicionar eventos de validação em tempo real para ambas as páginas
    document.getElementById('email').addEventListener('blur', validateEmail);
    document.getElementById('password').addEventListener('blur', validatePassword);
    
    // Validar formulário antes de enviar
    form.addEventListener('submit', function(event) {
        // Prevenir envio do formulário para validar primeiro
        event.preventDefault();
        
        if (isLoginPage) {
            // Para página de login, apenas validar email e senha
            const isEmailValid = validateEmail();
            const isPasswordValid = validatePassword();
            
            if (isEmailValid && isPasswordValid) {
                form.submit();
            }
        } else if (isPasswordResetPage) {
            // Para página de solicitação de reset de senha, apenas validar email
            const isEmailValid = validateEmail();
            
            if (isEmailValid) {
                form.submit();
            }
        } else if (document.getElementById('password_confirmation')) {
            // Para página de definição de nova senha
            const isPasswordValid = validatePassword();
            
            // Validar confirmação de senha se existe o campo
            let isPasswordConfirmationValid = true;
            if (document.getElementById('password_confirmation')) {
                isPasswordConfirmationValid = validatePasswordConfirmation();
            }
            
            if (isPasswordValid && isPasswordConfirmationValid) {
                form.submit();
            }
        } else {
            // Para página de registro, validar todos os campos
            const isEmailValid = validateEmail();
            const isPasswordValid = validatePassword();
            const isNameValid = validateName();
            const isEmailConfirmationValid = validateEmailConfirmation();
            const isPasswordConfirmationValid = validatePasswordConfirmation();
            
            // Verificar se os elementos existem antes de validar
            let isTermosValid = true;
            if (document.getElementById('termos')) {
                isTermosValid = validateTermos();
            }
            
            let isCursoValid = true;
            if (document.getElementById('curso_id')) {
                isCursoValid = validateCurso();
            }
            
            // Se todas as validações passarem, enviar o formulário
            if (isNameValid && isEmailValid && isEmailConfirmationValid && 
                isPasswordValid && isPasswordConfirmationValid && 
                isTermosValid && isCursoValid) {
                form.submit();
            }
        }
    });
});