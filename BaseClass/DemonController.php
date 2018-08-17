<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 16/08/2018
 * Time: 08:18 PM
 */

namespace BaseClass;

use BaseClass\Socket;

class DemonController extends Socket{

    public $NameLog = "";


    public function setNameLog($NameLog){
        $this->NameLog = $NameLog;
    }

    public function showMessage($mensaje)
    {
        $mensaje = is_array($mensaje) ? print_r($mensaje, true) : $mensaje;
        if (function_exists("RegistrarLog")) {
            global $FolderLog;
            RegistrarLog($FolderLog.'/'.date('Ymd').'.log',
                date('Y/m/d H:i:s').": $mensaje \n");
        } else {
            echo date('Y/m/d H:i:s').": $mensaje \n";
        }
    }


}