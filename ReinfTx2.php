<?php
/**
 * author Caio César
 * @date 10/12/2019
 */
abstract class ReinfTx2
{  
    const token = "d00ee3c1ff1d7089b1204c38bc59a8d9";
    const url   = "https://api.tecnospeed.com.br/reinf/v1/evento/";   
   /**
    * @var eventoGeral array responsavel por armazenar dados da funcaoGetEventoGeral
    */
    protected $eventoGeral;

    /**
     * @var cabecario  responsavel por armazenar o cabecario do arquivo tx2
     */
    protected $cabecario;

    protected $cpfcnpjtransmissor;    
    protected $cpfcnpjempregador;
    protected $versaomanual;
    protected $ambiente;

    /**
     * @author Caio César Lacerda
     * @date 11/12/2019
     * @return valores da tabela de eventos geral
     */
    protected function getEventosGeral()
    {
        $eventoR1000 = [
            'tpamb'                 => 'tpAmb_4',
            'procemi'               => 'procEmi_5',
            'verproc'               => 'verProc_6',
            'idecontri'             => 'ideContri_7',
            'tpinsc'                => 'tpinsc_8',
            'nrinsc'                => 'nrInsc_9',
            'infocontri'            => 'infoContri_10',
            'inivalid'              => 'iniValid_13',
            'fimvalid'              => 'fimValid_14',
            'infocadastro'          => 'infoCadastro_15',
            'classtrib'             => 'classTrib_16',
            'indescrituracao'       => 'indEscrituracao_17',
            'inddesoneracao'        => 'indDesoneracao_18',
            'indacordoisenMulta'    => 'indAcordoIsenMulta_19',
            'indsitpj'              => 'indSitPJ_20',
            'contato'               => 'contato_21',
            'nmctt'                 => 'nmCtt_22',
            'cpfctt'                => 'cpfCtt_23',
            'fonefixo'              => 'foneFixo_24',
            'fonecel'               => 'foneCel_25',
            'email'                 => 'email_26',
            'softhouse'             => 'softHouse_27',
            'cnpjsofthouse'         => 'cnpjSoftHouse_28',
            'nmrazaosofthouse'               => 'nmRazao_29',
            'nmcontsoufhouse'                => 'nmcont_30',
            'telefonesofthouse'              => 'telefone_31',
            'emailsofthouse'                 => 'email_32',
            'infoefr'               => 'infoEFR_33',
            'ideefr'                => 'ideEFR_34',
            'cnpjefr'               => 'cnpjEFR_35',
            'iniNovavalid'              => 'iniValid_36',
            'fimNovavalid'              => 'fimValid_37'
        ];
        return $eventoR1000;
    }

    /** método responsavel por pegar as inforção de eventoR1000 nas classes filhas */
    protected abstract function getTabEventos();

    /** método responsavel por gerar o tx2 */
    protected abstract function inclusao($var);

    /**
     * @author Caio César Lacerda
     * @date 10/12/2019
     * @return valores formatados para a criação do arquivo tx2
     */
    protected function formataValoresTx2($dadosBD,$arrayDeEventos)
    {
        $chavesEncontradas = (array)array_intersect_key((array)$arrayDeEventos,$dadosBD);
        
        $chavesCorretas = [];
        foreach($dadosBD as $key => $chave) {
            
            if (array_key_exists($key, $chavesEncontradas)){
                
             array_push($chavesCorretas,[$chavesEncontradas[''.$key.''] => $chave]);

            }
        }

        return $chavesCorretas;
    } 

    /**
     * @author Caio César Lacerda
     * @date 11/12/2019
     * @return resultado do envio da informações para a api - tecnospeed
     */

    protected function callApiTecnospeed(String $acao, String $tx2, String $ambiente, String $cnpj_sh)
    {   
     
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => Self::url.$acao,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $tx2,
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
              "ambiente: ".$ambiente."",
              "cache-control: no-cache",
              "cnpj_sh: ".$cnpj_sh."",
              "token_sh: ".self::token.""
            ),
          ));


        $response = curl_exec($curl);


        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {

        echo "cURL Error #:" . $err;
        } else {
            
            echo $response;
        }
    }

    /**
     * @author Caio César Lacerda
     * @date 12/12/2019
     * @return Cria cabeçario para o tx2
     */    
    protected function criaCabecario()
   {    
        $cabecario  = "";
        $cabecario .= 'cpfcnpjtransmissor='.$this->cpfcnpjtransmissor.PHP_EOL;
        $cabecario .= $this->espacos.'cpfcnpjempregador='.$this->cpfcnpjempregador.PHP_EOL;
        $cabecario .= $this->espacos.'versaomanual='.$this->versaomanual.PHP_EOL;
        $cabecario .= $this->espacos.'ambiente='.$this->ambiente.PHP_EOL;
        
        return $cabecario;       
   }
}
