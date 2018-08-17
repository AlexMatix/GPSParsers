<?php
namespace BaseClass;
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 14/08/2018
 * Time: 08:42 PM
 */

class Socket
{

    public $puerto;

    public $tipoConexion;

    public $isValidData        = true;

    public $tiposConexion      = array('TCP', 'UDP');

    public $socket             = null;

    public $address            = '0.0.0.0';

    public $resultSending      = 0;

    public $messageSended      = false;

    public $messageToSend      = '';

    protected $socketSendedMessage = null;

    protected $endLoop           = false;

    protected $allSocketsTCP     = array();

    protected $newClient         = null;

    protected $disconnectedClient = null;

    protected $length            = 2048;

    protected $currentSocket     = null;

    protected $clientPort        = 0;

    protected $clientAddress     = '';

    protected $data              = null;

    protected $lengthData        = 0;

    protected $lastErrorNo       = 0;

    protected $numberSockets     = 0;

    protected $timeSocketSelect  = 5;

    protected $erroresCliente    = array(107, 104); // errores de broken pipe y end point disconected

    public function __construct( $puerto, $tipoConexion = 'TCP' ){
        $this->puerto       = $puerto;
        $this->tipoConexion = $tipoConexion;
        $this->createSocket();
    }

    public function createSocket(){
        if (in_array($this->tipoConexion, $this->tiposConexion)) {
            switch ($this->getConnectionType()) {
                case 'TCP':
                    $this->createSocketTCP();
                    break;
                case 'UDP' :
                    $this->createSocketUDP();
                    break;
            }
        }
    }
    public function createSocketUDP(){
        $socket       = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        $this->findSocketError($socket);
        $this->socket = $socket;
        unset($socket);
    }

    public function createSocketTCP(){
        $proto  = getprotobyname('tcp');
        $proto  = $proto ? $proto : SOL_TCP;
        $socket = socket_create(AF_INET, SOCK_STREAM, $proto);

       // $this->findSocketError($socket);
        socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
        socket_set_option($socket, SOL_SOCKET, SO_KEEPALIVE, 1);
        //$this->findSocketError($socket);

        $this->allSocketsTCP[] = $socket;
        $this->socket          = $socket;
        $this->refreshNumberSockets();
        unset($socket);
    }

    public function setNumberSockets($number){
        $this->numberSockets = $number;
    }

    public function refreshNumberSockets(){
        $this->setNumberSockets(count($this->allSocketsTCP));
    }

    public function setLengthDataToRead($length){
        $this->length = $length;
    }


}