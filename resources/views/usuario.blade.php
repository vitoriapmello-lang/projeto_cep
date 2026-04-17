
<form method='POST' action='/usuario/salvar'>
    @csrf
    Nome:<input type='text' name ='nome'><br>
    Email:<input type='text' name ='email'><br>
    CEP:<input type='text' id='cep' name ='cep'><br>
    Rua:<input type='text' id='rua' name ='rua'><br>
    Bairro:<input type='text' id='bairro' name ='bairro'><br>
    Cidade:<input type='text' id='cidade' name ='cidade'><br>
    Estado:<input type='text' id='estado' name ='estado'><br>
    <button>Salvar</button>

</form>

<script>
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
</script>

