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

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="{{ PagSeguro::getUrl()['javascript'] }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/pagseguro.js') }}"></script>

    <script>
        const paymentData = {
            brand: '',
            amount: {{ 199.00 }},
        }

        PagSeguroDirectPayment.setSessionId('{{ PagSeguro::startSession() }}');

        pagSeguro.getPaymentMethods(paymentData.amount)
        .then(function (urls) {
            let html = '';

            urls.forEach(function (url) {
                html += '<img src="' + url + '" class="credit_card">'
            });

            $('#payment_methods').html(html);
        });
    
        $('#nomeCredito').on('blur', function () {
            pagSeguro.getSenderHash().then(function(data) {
                $('#senderHashCredito').val(data);
            })
        });

        $('#numeroCartao').on('keyup', function() {
            if ($(this).val().length >= 6) {
                let number = trim($(this).val());

                pagSeguro.getBrand(number)
                    .then(function (res) {
                        paymentData.brand = res.result.brand.name;
                        $('#flagIcon').html('<img src="' + res.url + '" class="credit_card">')
                        $('#paymentFlags').show();
                        return pagSeguro.getInstallments(paymentData.amount, paymentData.brand);
                    })
                    .then(function(res) {
                        let html = '';
                        res.forEach(function (item) {
                            html += '<option value="' + item.quantity + '">' + item.quantity + 'x R$' + item.installmentAmount + ' - Total: R$' + item.totalAmount + '</option>'
                        });
                        $('#installmentQuantity').html(html);
                        $('#installmentValue').val(res[0].installmentAmount);
                        $('#installmentQuantity').on('change', function () {
                            let value = res[$('#installmentQuantity').val() - 1].installmentAmount;
                            $('#installmentValue').val(value);
                        });
                    })
            }
        });

        $('#cvv').on('blur', function () {
            let params = {
                cardNumber: trim($("#numeroCartao").val()),
                cvv: $('#cvv').val(),
                expirationMonth: $("#validadeCartao").val().substring(0, 2),
                expirationYear: $("#validadeCartao").val().substring(3, 8),
                brand: paymentData.brand
            }
            pagSeguro.createCardToken(params).then(function (token) {
                $('#creditCardToken').val(token);
            });
        });


        // $('#creditoForm').on('submit', function (e) {
        //     e.preventDefault();
        //     let params = {
        //         cardNumber: trim($("#numeroCartao").val()),
        //         cvv: $('#cvv').val(),
        //         expirationMonth: $("#validadeCartao").val().substring(0, 2),
        //         expirationYear: $("#validadeCartao").val().substring(3, 8),
        //         brand: paymentData.brand
        //     }
        //     pagSeguro.createCardToken(params).then(function (token) {
        //         $('#creditCardToken').val(token);
        //         let url = $('#creditoForm').attr('action');
        //         let data = $('#creditoForm').serialize();

        //         $.post(url, data).then(function (result) {
        //            console.log(result);
        //         });
        //     });
        // });


    </script>
</html>
