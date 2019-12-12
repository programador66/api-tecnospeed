<?php
include_once "ReinfTx2.php";

 /**
 *  @inf R-1000 - Informações do Contribuinte
 */    

class R1000 extends ReinfTx2
{
   public $espacos = '        ';
   public function __construct(string $cpfcnpjtransmissor, string $cpfcnpjempregador, string $versaomanual, string $ambiente )
   {
       $this->cpfcnpjtransmissor = $cpfcnpjtransmissor;
       $this->cpfcnpjempregador = $cpfcnpjempregador;
       $this->versaomanual = $versaomanual;
       $this->ambiente = $ambiente;

       $this->eventoGeral = $this->getEventosGeral();
       $this->cabecario   = $this->criaCabecario();
   }

  /**
   * @author Caio César Lacerda
   * @date 11/12/2019
   * @return merge entre variaveis de tabela de eventos
   */  
   public function getTabEventos()
   {
    
    $eventosR1000 = (array)$this->eventoGeral;

    return $eventosR1000;

   }

  /**
   * @author Caio César Lacerda
   * @date 11/12/2019
   * @return txt com os dados formatados para o evento R1070
   */ 
   public function inclusao($dadosBd)
   {
    $acao = "enviar/tx2";
    $eventosR1000 = self::getTabEventos();    
    $valoresFormatados = self::formataValoresTx2($dadosBd,$eventosR1000);

    $arquivoEscrito = "";
    foreach( $valoresFormatados as $key  ) {
        foreach ( $key as $chave => $parametros ) {
        $arquivoEscrito .= $this->espacos.$chave.'='.$parametros.PHP_EOL;
        }
    }

    $softhouse = 
    $this->espacos.'INCLUIRSOFTHOUSE_27'.PHP_EOL.
    $this->espacos.'cnpjSoftHouse_28=26764821000198'.PHP_EOL.
    $this->espacos.'nmRazao_29=Nome Razao Teste'.PHP_EOL.
    $this->espacos.'nmCont_30=Nome teste'.PHP_EOL.
    $this->espacos.'telefone_31=1234567897'.PHP_EOL.
    $this->espacos.'email_32=email.teste@gmail.com'.PHP_EOL.
    $this->espacos.'SALVARSOFTHOUSE_27';

    $tx2 = $this->cabecario.$this->espacos.'INCLUIRR1000'.PHP_EOL.$arquivoEscrito.$softhouse.PHP_EOL.$this->espacos.'SALVARR1000';

    $response = self::callApiTecnospeed($acao,$tx2, $this->ambiente, $this->cpfcnpjtransmissor);
    return $response;

   }

}
