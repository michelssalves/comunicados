<?php

class FormatarCoresDoMenu extends VetoresAuxiliar{

    public function getAllCores()
    {


        $cbCores = '';
        $sql = $this->connection()->prepare("SELECT * FROM med_cores");
        //return var_dump($sql);
        if ($sql->execute()) {
            $qry = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        foreach ($qry as $row) {

            $cbCores .= '<option ' . $row['codigo'] . ' value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }


        return $cbCores;
    }
    public function getCampoById($idUsuario, $idCampo, $idMenu)
    {

        $sql = $this->connection()->prepare("SELECT id FROM med_cores_menu WHERE idMenu = :idMenu AND idCampo = :idCampo AND idUsuario = :idUsuario");
        $sql->bindValue('idUsuario', $idUsuario);
        $sql->bindValue('idMenu', $idMenu);
        $sql->bindValue('idCampo', $idCampo);
        if ($sql->execute()) {

            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }
    public function insertNewCampo($idUsuario, $idMenu, $idCampo, $idCor)
    {

        $sql = $this->connection()->prepare("INSERT INTO med_cores_menu (idUsuario, idMenu, idCampo, idCor) VALUES (:idUsuario, :idMenu, :idCampo, :idCor)");
        $sql->bindValue('idUsuario', $idUsuario);
        $sql->bindValue('idMenu', $idMenu);
        $sql->bindValue('idCampo', $idCampo);
        $sql->bindValue('idCor', $idCor);

        if ($sql->execute()) {

            return true;
        }

        return false;
    }
    public function updateCampo($id, $idCampo, $idCor)
    {

        $sql = $this->connection()->prepare("UPDATE med_cores_menu SET idCampo = :idCampo, idCor = :idCor WHERE id = :id");
        $sql->bindValue('id', $id);
        $sql->bindValue('idCampo', $idCampo);
        $sql->bindValue('idCor', $idCor);

        if ($sql->execute()) {

            return true;
        }

        return false;
    }
    public function insertValidarCampo($dados)
    {

        $id = $this->getCampoById($dados['idUsuario'], $dados['idCampo'], $dados['idMenu']);

        if (empty($id)) {
            $this->insertNewCampo($dados['idUsuario'], $dados['idMenu'], $dados['idCampo'], $dados['idCor']);
        } else {

            $this->updateCampo($id[0]['id'], $dados['idCampo'], $dados['idCor']);
        }
    }
    public function coresDoMenu($idUsuario, $idMenu)
    {

        $sql = $this->connection()->prepare("SELECT mcm.idUsuario, mc.campo, mco.codigo FROM med_cores_menu AS mcm
        JOIN med_campos AS mc
        ON mcm.idCampo = mc.id
        JOIN med_cores AS mco
        ON mcm.idCor = mco.id
        WHERE mcm.idUsuario = :idUsuario AND mc.idMenu = :idMenu");
        $sql->bindValue('idUsuario', $idUsuario);
        $sql->bindValue('idMenu', $idMenu);
        if ($sql->execute()) {

            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        $coresPorUsuario = array();
        foreach ($data as $item) {
            $coresPorUsuario[$item['campo']] = $item;
        }

        return $coresPorUsuario;
    }
    public function getCampos($idMenu)
    {
        $cbCampos = '';

        $sql = $this->connection()->prepare("SELECT * FROM med_campos WHERE idMenu = :idMenu");
        $sql->bindValue('idMenu', $idMenu);
        if ($sql->execute()) {

            $qry = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach ($qry as $row) {

                $cbCampos .= '<option value="' . $row['id'] . '">' . $row['campo'] . '</option>';
            }
        }

        return $cbCampos;
    }

}