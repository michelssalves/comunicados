<?php

class FormatarMenuSelect extends EnvioDeEmail{

    public function getAllMedsAtivos()
    {

        $cbFilial = '';
        $sql = $this->connection()->prepare("SELECT id, nomecompleto, id_xpert AS idXpert, loginName FROM ti_clientes
         WHERE id_xpert > 0 AND loginName IS NOT NULL AND inativo = 0 AND id NOT IN(2056) ORDER BY loginName");
        if ($sql->execute()) {
            $qry = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        foreach ($qry as $row) {
            $idMed = $row['id'];
            $nomeMed[$idMed] = $row['loginName'];
            $cbFilial .= '<option value="' . $idMed . '">' . $nomeMed[$idMed] . '</option>';
        }


        return $cbFilial;
    }
    public function getAllMedsAtivosIdXpert()
    {

        $cbFilial = '';
        $sql = $this->connection()->prepare("SELECT id, nomecompleto, id_xpert AS idXpert, loginName FROM ti_clientes
         WHERE id_xpert > 0 AND loginName IS NOT NULL AND inativo = 0  AND id NOT IN(2056) ORDER BY loginName");
        if ($sql->execute()) {
            $qry = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        foreach ($qry as $row) {
            $idMed = $row['idXpert'];
            $nomeMed[$idMed] = $row['loginName'];
            $cbFilial .= '<option value="' . $idMed . '">' . $nomeMed[$idMed] . '</option>';
        }


        return $cbFilial;
    }
    public function getAllMeds()
    {

        $cbFilial = '';
        $sql = $this->connection()->prepare("SELECT id, nomecompleto, id_xpert AS idXpert, loginName FROM ti_clientes
         WHERE id_xpert > 0 AND loginName IS NOT NULL AND id NOT IN(2056) ORDER BY loginName");
        if ($sql->execute()) {
            $qry = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        foreach ($qry as $row) {
            $idMed = $row['id'];
            $nomeMed[$idMed] = $row['loginName'];
            $cbFilial .= '<option value="' . $idMed . '">' . $nomeMed[$idMed] . '</option>';
        }


        return $cbFilial;
    }
    public function getAllCidadeOrigem()
    {

        $cbFilial = '';
        $sql = $this->connection()->prepare("SELECT DISTINCT IdEntidade , CidadeEntidade FROM med_compras_xpertN WHERE NomeEntidade LIKE 'IPIRANGA%' ORDER BY CidadeEntidade");
        if ($sql->execute()) {
            $qry = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        foreach ($qry as $row) {
            $idEntidade = $row['IdEntidade'];
            $cidadeEntidade[$idEntidade] = $row['CidadeEntidade'];
            $cbCidadeOrigem .= '<option value="' . $idEntidade . '">' . $cidadeEntidade[$idEntidade] . '</option>';
        }


        return $cbCidadeOrigem;
    }

   
    public function getProdutosXpert(){

        $cbProdutoXpert = '
            <option value="0">PRODUTO</option>
            <option value="1">GASOLINA C COMUM</option>
            <option value="2">GASOLINA C ADITIVADA</option>
            <option value="3">ETANOL</option>
            <option value="4">OLEO DIESEL B S500</option>
            <option value="5">OLEO DIESEL B S10</option>
            <option value="6">GNV</option>';
            
        return $cbProdutoXpert;   

    }
 

}