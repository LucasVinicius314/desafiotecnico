<?php

require_once('Conexao.php');

class Deputado
{
    public function Insert($id, $nome, $nomeServidor, $partido, $email)
    {
        try
        {
            $db = new Conexao();

            $conexao = $db->Conectar();

            $sql = $conexao->prepare("insert into deputados values(null, $id, '$nome', '$nomeServidor', '$partido', '$email');");

            $sql->execute();
        }
        catch (PDOException $ex)
        {
            echo($ex->getMessage());
            return null;
        }
    }

    public function Select($idDeputado)
    {
        try
        {
            $db = new Conexao();

            $conexao = $db->Conectar();

            $sql = $conexao->prepare("select nome from deputados where id = $idDeputado;");

            $sql->execute();

            if ($sql->rowCount() > 0) return $sql->fetchAll(PDO::FETCH_CLASS);
            else return null;
        }
        catch (PDOException $ex)
        {
            echo($ex->getMessage());
            return null;
        }
    }

    public function SelectAll()
    {
        try
        {
            $db = new Conexao();

            $conexao = $db->Conectar();

            $sql = $conexao->prepare("select id from deputados;");

            $sql->execute();

            if ($sql->rowCount() > 0) return $sql->fetchAll(PDO::FETCH_CLASS);
            else return null;
        }
        catch (PDOException $ex)
        {
            echo($ex->getMessage());
            return null;
        }
    }
}