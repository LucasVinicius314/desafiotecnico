<?php

class Conexao
{
    private $server;
    private $database;
    private $uid;
    private $password;

    function __construct()
    {
        $this->server = "localhost";
        $this->database = "desafiotecnico";
        $this->uid = "root";
        $this->password = "";
    }

    public function Conectar()
    {
        try {
            $conexao = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->database . ";charset=utf8;", $this->uid, $this->password);
            return $conexao;
        } catch (PDOException $ex) {
            echo ($ex->getMessage());
            return null;
        }
    }
}
