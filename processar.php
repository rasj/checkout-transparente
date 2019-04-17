<?php
    include_once __DIR__.DIRECTORY_SEPARATOR.'config.php';

	$url = $monetizzeApiUrl.'checkout/transparente/processar';
    $key = $monetizzeApiKey;


	$dados = array();
	$dados['referencia'] = $_POST['referencia'];
	$dados['chave_checkout'] = $_POST['chave_checkout'];
    $dados['fingerprint'] = $_POST['fingerprint'];
	$dados['meio_pagamento'] = $_POST['meio_pagamento'];


    $dados['nome'] = $_POST['nome'];
    $dados['email'] = $_POST['email'];
    $dados['cep'] = $_POST['cep'];
    $dados['cnpj_cpf'] = $_POST['cnpj_cpf'];
    $dados['quantidade'] = 1;

    $dados['NameOnCard'] = $_POST['NameOnCard'];
    $dados['CreditCardNumber'] = $_POST['CreditCardNumber'];
    $dados['ExpiryDate_month'] = $_POST['ExpiryDate_month'];
    $dados['ExpiryDate_year'] = $_POST['ExpiryDate_year'];
    $dados['SecurityCode'] = $_POST['SecurityCode'];
    $dados['bandCartao'] = $_POST['bandCartao'];
    $dados['parcelamento'] = $_POST['parcelamento'];
            




    $header = array();
    $header[] = 'Content-Type: application/json';
    $header[] = 'Api-Key: ' . $key ; 
    
  
	$data_string = json_encode($dados);
	$header[] = 'Content-Length: ' . strlen($data_string);


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);  
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);

    curl_close($ch);

    echo $result;

    // $r =  json_decode($result,true);