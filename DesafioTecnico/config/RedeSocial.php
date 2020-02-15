<?php

require_once('Conexao.php');

class RedeSocial
{
    public function Insert($nome, $url, $deputados_id)
    {
        try
        {
            $db = new Conexao();

            $conexao = $db->Conectar();

            $sql = $conexao->prepare("insert into redes_sociais values(null, '$nome', '$url', $deputados_id);");

            $sql->execute();
        }
        catch (PDOException $ex)
        {
            echo($ex->getMessage());
            return null;
        }
    }

    public function SelectDistinct()
    {
        try
        {
            $db = new Conexao();

            $conexao = $db->Conectar();

            $sql = $conexao->prepare("select distinct nome from redes_sociais;");

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

    public function SelectAmount($nome)
    {
        try
        {
            $db = new Conexao();

            $conexao = $db->Conectar();

            //var_dump($conexao->prepare("select count(*) from redes_sociais where nome = '$nome';"));

            $sql = $conexao->prepare("select count(*) from redes_sociais where nome = '$nome';");

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