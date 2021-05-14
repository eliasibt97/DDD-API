<?php

class DBConfig extends PDO {
    public $db_connect;
    private $db_host = 'localhost';
    private $db_name = 'garage290';
    private $db_user = 'garage290db';
    private $db_pass = 'B45eTpR1';

    public function __construct(){

        if(is_null($this->db_connect)){
            $this->db_connect = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name,
                                         $this->db_user, $this->db_pass);
        }
        return $this->db_connect;
    }
}