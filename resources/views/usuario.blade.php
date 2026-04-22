<form method='POST' action='/usuario/salvar' id='form-usuario'>
    @csrf
    Nome: <input type='text' name='nome'><br>
    
    Email: <input type='text' id='email' name='email'>
    <span id='erro-email' style='color: red; display: none; font-size: 0.9em;'>Por favor, insira um e-mail válido.</span><br>
    
    CEP: <input type='text' id='cep' name='cep'><br>
    Rua: <input type='text' id='rua' name='rua'><br>
    Bairro: <input type='text' id='bairro' name='bairro'><br>
    Cidade: <input type='text' id='cidade' name='cidade'><br>
    Estado: <input type='text' id='estado' name='estado'><br>
    
    <button type="submit">Salvar</button>
</form>

<script>
    // --- 1. Integração com ViaCEP ---
    document.getElementById('cep').addEventListener('blur', function(){
        let cep = this.value.replace(/\D/g, '');
        if(cep.length === 8){
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if(data.erro){
                    alert('CEP não encontrado!');
                    return;
                }
                document.getElementById('rua').value = data.logradouro;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('estado').value = data.uf;
            });
        }
    });

    // --- 2. Validação de E-mail com Regex ---
    document.getElementById('form-usuario').addEventListener('submit', function(event) {
        let emailInput = document.getElementById('email').value.trim();
        let mensagemErro = document.getElementById('erro-email');
        
        // Regex para validar o formato do e-mail
        let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Se o e-mail não passar no teste do Regex
        if (!regexEmail.test(emailInput)) {
            event.preventDefault(); // Impede o envio do formulário
            mensagemErro.style.display = 'inline'; // Mostra a mensagem de erro vermelha
            document.getElementById('email').focus(); // Coloca o cursor de volta no campo de e-mail
        } else {
            mensagemErro.style.display = 'none'; // Esconde a mensagem se estiver tudo certo
        }
    });
</script>