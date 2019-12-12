<?php
include_once "ReinfTx2.php";

 /**
 *  @inf R-1070 - Tabela de Processos Administrativos/Judiciais
 */    

class R1070 extends ReinfTx2
{
   
  /**
   * @var tabProcessosR1070 array responsavel por armazenar variáveis da tabela de eventos R1070
   */
   protected $tabProcessosR1070;

   public function __construct(string $cpfcnpjtransmissor, string $cpfcnpjempregador, string $versaomanual, string $ambiente )
   {
       $this->cpfcnpjtransmissor = $cpfcnpjtransmissor;
       $this->cpfcnpjempregador = $cpfcnpjempregador;
       $this->versaomanual = $versaomanual;
       $this->ambiente = $ambiente;

       $this->tabProcessosR1070 = [
            'infoprocesso' => 'infoProcesso_10',
            'ideprocesso'  => 'ideProcesso_12',
            'tpproc'       => 'tpProc_16',
            'nrproc'       => 'nrProc_17',
            'indautoria'   => 'indAutoria_27',
            'infosusp'     => 'infoSusp_18',
            'codsusp'      => 'codSusp_19',
            'indsusp'      => 'indSusp_20',
            'dtdecisao'    => 'dtDecisao_21',
            'inddeposito'  => 'indDeposito_22',
            'dadosprocjud' => 'dadosProcJud_23',
            'ufVara'       => 'ufvara_24',
            'codmunic'     => 'codMunic25',
            'idvara'       => 'idVara_26',
            'inivalid1070' => 'iniValid_28',
            'fimvalid1070' => 'fimValid_29'         
       ];
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
    
    $eventosR1070 = array_merge((array)$this->eventoGeral,(array)$this->tabProcessosR1070);

    return $eventosR1070;

   }

  /**
   * @author Caio César Lacerda
   * @date 11/12/2019
   * @return txt com os dados formatados para o evento R1070
   */ 
   public function inclusao($dadosBd)
   {

    $eventosR1070 = self::getTabEventos();    
    $valoresFormatados = self::formataValoresTx2($dadosBd,$eventosR1070);

    $arquivoEscrito = "";
    foreach( $valoresFormatados as $key  ) {
        foreach ( $key as $chave => $parametros ) {
        $arquivoEscrito .= $chave.'='.$parametros.'\n';
        }
    }

    $tx2 = $this->cabecario.'INCLUIRR1070\n'.$arquivoEscrito.'SALVARR1070';

    return $tx2;

   }

}
