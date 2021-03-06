<?php

namespace App\Http\Controllers;

use PagSeguro;
use Helper;
use Artistas\PagSeguro\PagSeguroException;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{

    public function boleto(Request $request)
    {
        try {
            $boleto = PagSeguro::setReference('1')
                ->setSenderInfo([
                    'senderName' => $request->input('nome'),
                    'senderPhone' => $request->input('telefone'),
                    'senderEmail' => $request->input('email'),
                    'senderHash' => $request->input('senderHashBoleto'),
                    'senderCPF' => $request->input('cpf'),
                    'senderCNPJ' => null
                ])
                ->setShippingAddress([ //OPCIONAL
                    'shippingAddressStreet' => 'Rua/Avenida',
                    'shippingAddressNumber' => 'Número',
                    'shippingAddressDistrict' => 'Bairro',
                    'shippingAddressComplement' => 'Complemento',
                    'shippingAddressPostalCode' => '12345-678',
                    'shippingAddressCity' => 'Cidade',
                    'shippingAddressState' => 'DF'
                ])
                ->setItems([
                    [
                        'itemId' => 'ID',
                        'itemDescription' => 'Nome do Item',
                        'itemAmount' => 12.14, //Valor unitário
                        'itemQuantity' => '2', //Quantidade de itens
                    ],
                    [
                        'itemId' => 'ID 2',
                        'itemDescription' => 'Nome do Item 2',
                        'itemAmount' => 12.14,
                        'itemQuantity' => '2',
                    ]
                ])
                ->send([
                    'paymentMethod' => 'boleto'
                ]);

            dd($boleto->paymentLink);
        } catch (PagSeguroException $e) {
            dd($e);
            //$e->getCode();
            //$e->getMessage();
        }
    }

    public function debito(Request $request)
    {
        try {
            $debito = PagSeguro::setReference('1')
                ->setSenderInfo([
                    'senderName' => $request->input('nome'),
                    'senderPhone' => $request->input('telefone'),
                    'senderEmail' => $request->input('email'),
                    'senderHash' => $request->input('senderHashDebito'),
                    'senderCPF' => $request->input('cpf'),
                    'senderCNPJ' => null
                ])
                ->setShippingAddress([ //OPCIONAL
                    'shippingAddressStreet' => 'Rua/Avenida',
                    'shippingAddressNumber' => 'Número',
                    'shippingAddressDistrict' => 'Bairro',
                    'shippingAddressComplement' => 'Complemento',
                    'shippingAddressPostalCode' => '12345-678',
                    'shippingAddressCity' => 'Cidade',
                    'shippingAddressState' => 'DF'
                ])
                ->setItems([
                    [
                        'itemId' => 'ID',
                        'itemDescription' => 'Nome do Item',
                        'itemAmount' => 12.14, //Valor unitário
                        'itemQuantity' => '2', //Quantidade de itens
                    ],
                    [
                        'itemId' => 'ID 2',
                        'itemDescription' => 'Nome do Item 2',
                        'itemAmount' => 12.14,
                        'itemQuantity' => '2',
                    ]
                ])
                ->send([
                    'paymentMethod' => 'eft',
                    'bankName' => 'itau'
                ]);

            dd($debito->paymentLink);
        } catch (PagSeguroException $e) {
            dd($e);
            //$e->getCode();
            //$e->getMessage();
        }
    }

    public function credito(Request $request)
    {
        $cpf = Helper::cpf($request->input('cpf')); 

        dd($cpf);
        
        try {
            $credito = PagSeguro::setReference('1')
                ->setSenderInfo([
                    'senderName' => $request->input('nomeCredito'),
                    'senderPhone' => $request->input('telefone'),
                    'senderEmail' => $request->input('email'),
                    'senderHash' => $request->input('senderHashCredito'),
                    'senderCPF' => $cpf,
                    'senderCNPJ' => null
                ])
                ->setCreditCardHolder([
                    'creditCardHolderName' => $request->input('nome'), //OPCIONAL
                    'creditCardHolderPhone' => $request->input('telefone'), //OPCIONAL
                    'creditCardHolderCPF' => $cpf, //OPCIONAL
                    'creditCardHolderBirthDate' => $request->input('dataNascimento'),
                ])
                ->setShippingAddress([ //OPCIONAL
                    'shippingAddressStreet' => 'Rua/Avenida',
                    'shippingAddressNumber' => 'Número',
                    'shippingAddressDistrict' => 'Bairro',
                    'shippingAddressComplement' => 'Complemento',
                    'shippingAddressPostalCode' => '12345-678',
                    'shippingAddressCity' => 'Cidade',
                    'shippingAddressState' => 'DF'
                ])
                ->setBillingAddress([ //OPCIONAL
                    'billingAddressStreet' => 'Rua/Avenida',
                    'billingAddressNumber' => 'Número',
                    'billingAddressDistrict' => 'Bairro',
                    'billingAddressPostalCode' => '12345-678',
                    'billingAddressCity' => 'Cidade',
                    'billingAddressState' => 'DF'
                ])
                ->setItems([
                    [
                        'itemId' => '123456',
                        'itemDescription' => 'Item Certificado',
                        'itemAmount' => 199.00, 
                        'itemQuantity' => '1'
                    ],
                ])
                ->send([
                    'paymentMethod' => 'creditCard',
                    'creditCardToken' => $request->input('creditCardToken'),
                    'installmentQuantity' => $request->input('installmentQuantity'),
                    'installmentValue' => $request->input('installmentValue'),
                ]);

            dd($credito);
        } catch (PagSeguroException $e) {
            dd($e);
            //$e->getCode();
            //$e->getMessage();
        }
    }

    private function trim($str) {
        $stripped = str_replace(' ', '', $str);
        dd($str);
    }
}
