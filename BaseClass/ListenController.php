<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 16/08/2018
 * Time: 09:00 PM
 */

namespace BaseClass;


class ListenController
{

    public function __construct(){

        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        set_error_handler('myHandlerError',E_ALL);
        session_start();
        set_time_limit(0);
        define('SERVERZONE', date('e'));
    }
}