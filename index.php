<?php

include_once "ReinfTx2.php";
include_once "R1070.php";
include_once "R1000.php";

    
$cpfcnpjtransmissor='02570039241';
$cpfcnpjempregador='08187168000160';
$versaomanual='1.3.0';
$ambiente='2';

$teste = [
    strtolower('tpAmb') =>  '2',
    strtolower('procEmi')   =>  '1',
    strtolower('verProc')=>'1.0',
    strtolower('tpInsc')=>'1',
    strtolower('nrInsc')=>'08187168',
    strtolower('iniValid')=>'2017-10',
    strtolower('fimValid')=>'',
    strtolower('classTrib')=>'01',
    strtolower('indEscrituracao')=>'0',
    strtolower('indDesoneracao')=>'1',
    strtolower('indAcordoIsenMulta')=>'0',
    strtolower('indSitPJ')=>'0',
    strtolower('nmCtt')=>'Nome do Contato Teste',
    strtolower('cpfCtt')=>'12345678909',
    strtolower('foneFixo')=>'1123452345',
    strtolower('foneCel')=> '',
    strtolower('email')=> '',
    strtolower('ideEFR')=> '',
    strtolower('cnpjEFR_35')=> '' 
];

// $r1070 = new R1070($cpfcnpjtransmissor, $cpfcnpjempregador, $versaomanual, $ambiente);
$r1000 = new R1000($cpfcnpjtransmissor, $cpfcnpjempregador, $versaomanual, $ambiente);

echo "<pre>";
print_r($r1000->inclusao($teste));

