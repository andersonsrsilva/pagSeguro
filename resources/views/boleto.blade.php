<div class="mt-4">
    <h2>Boleto</h2>

    <form method="POST" action="/pagamento/boleto">

        @csrf
        <input type="hidden" id="senderHashBoleto" name="senderHashBoleto">

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
            <div class="form-group col-md-6">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control cpf" id="cpf" name="cpf" value="72678356191">
            </div>
            <div class="form-group col-md-6">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control telefone" id="telefone" name="telefone" value="(61) 9 8641-2007">
            </div>
        </div>
        <button type="submit" onclick="getSenderHash()" class="btn btn-primary">Gerar</button>
    </form>
</div>
