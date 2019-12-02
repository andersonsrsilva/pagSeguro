<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PagSeguro</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#boleto" role="tab" aria-controls="boleto" aria-selected="true">Boleto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#debito" role="tab" aria-controls="debito" aria-selected="false">Débito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#credito" role="tab" aria-controls="credito" aria-selected="false">Crédito</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="boleto" role="tabpanel" aria-labelledby="boleto-tab">
                @includeWhen(true, 'boleto')
            </div>
            <div class="tab-pane fade" id="debito" role="tabpanel" aria-labelledby="debito-tab">
                @includeWhen(true, 'debito')
            </div>
            <div class="tab-pane fade show active" id="credito" role="tabpanel" aria-labelledby="credito-tab">
                @includeWhen(true, 'credito')
            </div>
        </div>
    </body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="{{ PagSeguro::getUrl()['javascript'] }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        PagSeguroDirectPayment.setSessionId('{{ PagSeguro::startSession() }}');
    </script>
</html>
