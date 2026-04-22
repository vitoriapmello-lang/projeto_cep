import './bootstrap';

// Função pura para validar o e-mail com Regex
function isEmailValido(email) {
    // Regex que verifica o formato: texto + @ + texto + . + texto
    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regexEmail.test(email);
}

// Lógica para aplicar a validação no formulário (opcional)
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-contato'); // Substitua pelo ID do seu formulário
    const emailInput = document.getElementById('email');
    const mensagemErro = document.getElementById('erro-email');

    if (form && emailInput) {
        form.addEventListener('submit', function (event) {
            const email = emailInput.value.trim();

            if (!isEmailValido(email)) {
                event.preventDefault(); // Impede o envio do formulário se o e-mail for inválido
                
                // Exibe a mensagem de erro
                mensagemErro.style.display = 'block';
                mensagemErro.innerText = 'Por favor, insira um e-mail válido.';
                
                // Adiciona uma classe de erro (ex: para estilizar com Bootstrap ou Tailwind)
                emailInput.classList.add('is-invalid'); 
            } else {
                // Esconde a mensagem de erro caso o e-mail seja corrigido
                mensagemErro.style.display = 'none';
                emailInput.classList.remove('is-invalid');
            }
        });
    }
});