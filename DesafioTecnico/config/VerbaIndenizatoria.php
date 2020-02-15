<?php

require_once('Conexao.php');

class VerbaIndenizatoria
{
    public function Insert($nome, $mes, $deputados_id)
    {
        try
        {
            $db = new Conexao();

            $conexao = $db->Conectar();

            $sql = $conexao->prepare("insert into verbas_indenizatorias values(null, '$nome', $mes, $deputados_id);");

            $sql->execute();
        }
        catch (PDOException $ex)
        {
            echo($ex->getMessage());
            return null;
        }
    }

    public function Select()
    {
        try
        {
            $db = new Conexao();

            $conexao = $db->Conectar();

            $sql = $conexao->prepare("select distinct idDeputado from verbas_indenizatorias;");

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

    public function SelectAmount($idDeputado)
    {
        try
        {
            $db = new Conexao();

            $conexao = $db->Conectar();

            //var_dump($conexao->prepare("select count(*) from redes_sociais where nome = '$nome';"));

            $sql = $conexao->prepare("select count(*) from verbas_indenizatorias where idDeputado = '$idDeputado';");

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

    public function SelectName($idDeputado)
    {
        try
        {
            $db = new Conexao();

            $conexao = $db->Conectar();

            //var_dump($conexao->prepare("select count(*) from redes_sociais where nome = '$nome';"));

            $sql = $conexao->prepare("select nome from verbas_indenizatorias where idDeputado = '$idDeputado';");

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