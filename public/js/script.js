$(document).ready(function () {
    $('.telefone').mask('(00) 0 0000-0000');
    $('.cpf').mask('000.000.000-00', { reverse: true });
    $('.data').mask("00/00/0000", { selectOnFocus: true });
    $('.cvvCartao').mask("000", { reverse: true });
    $('.validadeCartao').mask("00/0000", { reverse: true });
    $('.numeroCartao').mask("0000 0000 0000 0000", { reverse: true });

    $('#paymentFlags').hide();
});

function trim(str) {
    while (str.indexOf(" ") != -1) {
        str = str.replace(" ", "");
    }
    return str;
}


