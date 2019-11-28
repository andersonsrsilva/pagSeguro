<div class="mt-4">
    <h2>Crédito</h2>

    <form method="POST" action="/pagamento/credito">

        @csrf
        <input type="hidden" id="senderHashCredito" name="senderHashCredito">
        <input type="hidden" id="creditCardToken" name="creditCardToken">

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="Anderson Santa Rosa da Silva">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="andersonsrsilva@gmail.com">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control cpf" id="cpf" name="cpf" value="72678356191">
            </div>
            <div class="form-group col-md-4">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control telefone" id="telefone" name="telefone" value="(61) 9 8641-2007">
            </div>
            <div class="form-group col-md-4">
                <label for="dataNascimento">Data Nascimento</label>
                <input type="text" class="form-control data" id="dataNascimento" name="dataNascimento" value="03/09/1983">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="numeroCartao">Número do Cartão</label>
                <input type="text" class="form-control numeroCartao" id="numeroCartao" name="numeroCartao" value="4111111111111111">
            </div>
            <div class="form-group col-md-4">
                <label for="validadeCartao">Validade</label>
                <input type="text" class="form-control validadeCartao" id="validadeCartao" name="validadeCartao" value="12/2030">
            </div>
            <div class="form-group col-md-2">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control cvvCartao" id="cvv" name="cvv" value="123">
            </div>
        </div>
        <button type="button" onclick="getValidade()" class="btn btn-primary">Gerar</button>
    </form>
</div>
