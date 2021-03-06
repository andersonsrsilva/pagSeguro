<div class="mt-4">
    <h2>Crédito</h2>

    <form method="POST" action="/pagamento/credito" id="creditoForm">

        @csrf
        <input type="hidden" id="senderHashCredito" name="senderHashCredito">
        <input type="hidden" id="creditCardToken" name="creditCardToken">
        <input type="hidden" id="installmentValue" name="installmentValue">

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nomeCredito" name="nomeCredito" value="Anderson Santa Rosa da Silva">
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
                <div class="input-group">
                    <input type="text" class="form-control numeroCartao" id="numeroCartao" name="numeroCartao" value="4111111111111111">
                    <div id="paymentFlags" class="input-group-append">
                        <span id="flagIcon" class="input-group-text bg-transparent"></span>
                    </div>
                </div>
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
        <div class="form-row">
            <div class="form-group col-md-6">
                <select class="form-control" name="installmentQuantity" id="installmentQuantity" class="browser-default">
                    <option disabled selected>Parcelamento</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Comprar</button>

        <br><br>

        <div id="payment_methods" class="center-align"></div>

    </form>
</div>
