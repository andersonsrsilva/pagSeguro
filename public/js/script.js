$(document).ready(function () {
    $('.telefone').mask('(00) 0 0000-0000');
    $('.cpf').mask('000.000.000-00', { reverse: true });
    $('.data').mask("00/00/0000", { selectOnFocus: true });
    $('.cvvCartao').mask("000", { reverse: true });
    $('.validadeCartao').mask("00/0000", { reverse: true });
    $('.numeroCartao').mask("0000 0000 0000 0000", { reverse: true });

    $('#paymentFlags').hide();

    var brand = '';
    var amount = 500.00;

    $('#numeroCartao').on('keyup', function() {
        let number = trim($(this).val());

        if (number.length >= 6) {
            PagSeguroDirectPayment.getBrand({
                cardBin: number,
                success: function(response) {
                        brand = response.brand.name;

                        let url = "https://stc.pagseguro.uol.com.br//public/img/payment-methods-flags/42x20/" + response.brand.name + ".png";
                        $('#flagIcon').prepend('<img src="' + url + '" class="credit_card" />')
                        $('#paymentFlags').show();
                },
                error: function(response) {
                    console.log(response);
                }
            });

            PagSeguroDirectPayment.getInstallments({
                amount,
                success: function(response) {
                    let html = '';
                    let parcelas = response.installments[brand];

                    parcelas.forEach(function (item) {
                        html += '<option value="' + item.quantity + '">' + item.quantity + 'x R$' + item.installmentAmount + ' - Total: R$' + item.totalAmount + '</option>'
                    });

                    $('#installmentQuantity').html(html);
                    $('#installmentValue').val(response[0].installmentAmount);
                    $('#installmentQuantity').on('change', function () {
                        let value = response[$('#installmentQuantity').val() - 1].installmentAmount;
                        $('#installmentValue').val(value);
                    });


                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
    });
});

function getSenderHash() {
    $("#senderHashBoleto").val(PagSeguroDirectPayment.getSenderHash());
    $("#senderHashDebito").val(PagSeguroDirectPayment.getSenderHash());
    $("#senderHashCredito").val(PagSeguroDirectPayment.getSenderHash());
}

function getValidade() {
    var param = {
        cardNumber: trim($("#numeroCartao").val()),
        cvv: $("#cvv").val(),
        brand: 'visa',
        expirationMonth: $("#validadeCartao").val().substring(0, 2),
        expirationYear: $("#validadeCartao").val().substring(3, 8),
        success: function (response) {
            console.log(response);
        },
        error: function (response) {
            console.log(response);
        },
        complete: function (response) {
            console.log(response);
        },
    }
    PagSeguroDirectPayment.createCardToken(param);
}

function trim(str) {
    while (str.indexOf(" ") != -1) {
        str = str.replace(" ", "");
    }
    return str;
}

PagSeguroDirectPayment.createCardToken({
    cardNumber: trim($("#numeroCartao").val()),
    brand: '411111',
    cvv: $("#cvv").val(),
    expirationMonth: $("#validadeCartao").val().substring(0, 2),
    expirationYear: $("#validadeCartao").val().substring(3, 8),
    success: function (response) {
        var objToken = response;
        var TOKEN = objToken["card"].token;
        $("#creditCardToken").val(TOKEN);
    }
});
