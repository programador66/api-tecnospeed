<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.tecnospeed.com.br/reinf/v1/evento/enviar/tx2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "cpfcnpjtransmissor=02570039241\ncpfcnpjempregador=08187168000160\nversaomanual=1.3.02\nambiente=2\nINCLUIRR1000\ntpAmb_4=2\nprocEmi_5=1\nverProc_6=1.0\ntpInsc_8=1\nnrInsc_9=08187168\niniValid_13=2017-10\nfimValid_14=\nclassTrib_16=01\nindEscrituracao_17=0\nindDesoneracao_18=1\nindAcordoIsenMulta_19=0\nindSitPJ_20=0\nnmCtt_22=Nome do Contato Teste\ncpfCtt_23=12345678909\nfoneFixo_24=1123452345\nfoneCel_25=\nemail_26=\nideEFR_34=\ncnpjEFR_35=\nINCLUIRSOFTHOUSE_27\ncnpjSoftHouse_28=26764821000198\nnmRazao_29=Nome Razao Teste\nnmCont_30=Nome teste\ntelefone_31=1234567897\nemail_32=email.teste@gmail.com\nSALVARSOFTHOUSE_27\nSALVARR1000",
  CURLOPT_HTTPHEADER => array(
    "Accept: */*",
    "Accept-Encoding: gzip, deflate",
    "Cache-Control: no-cache",
    "Connection: keep-alive",
    "Content-Length: 607",
    "Content-Type: text/plain",
    "Host: api.tecnospeed.com.br",
    "Postman-Token: b04ab8f0-ac2c-4b7d-89dc-a2f5a3def655,08552cf6-222d-4210-a353-66c2803a874b",
    "User-Agent: PostmanRuntime/7.20.1",
    "ambiente: 2",
    "cache-control: no-cache",
    "cnpj_sh: 02570039241",
    "token_sh: d00ee3c1ff1d7089b1204c38bc59a8d9"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {

  echo "cURL Error #:" . $err;
} else {
    echo "<pre>";
    print_r(json_decode($response));
}