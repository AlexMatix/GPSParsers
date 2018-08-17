<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 16/08/2018
 * Time: 10:20 PM
 */

namespace Traits;


class Connect
{

    public $connection;

    protected $user     = "";
    protected $password = "";
    protected $dataBase = "";
    protected $host     = "";

    public function connect(){
        $connect = "mysql:host=".$this->host.";dbname=".$this->dataBase;
        try{
            $this->connection = new PDO($connect, $this->user, $this->password);
        }catch (PDOException $e){
            print_r("No se pudo completar la conexioón:: ERROR ---> [$e]");
        }

    }

    public function changeConecction($dataBase){
        $this->$dataBase = $dataBase;
    }

}