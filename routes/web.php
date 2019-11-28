<?php

Route::get('/', function () {
    return view('welcome');
});

Route::post('/pagamento/boleto', 'PagamentoController@boleto');
Route::post('/pagamento/debito', 'PagamentoController@debito');
Route::post('/pagamento/credito', 'PagamentoController@credito');
