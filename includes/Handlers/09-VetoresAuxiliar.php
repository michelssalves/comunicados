<?php

class VetoresAuxiliar extends FormatarTextos {

    public function getVetorDeMeds()
    {
        $sql = $this->connection()->prepare("SELECT id, nomecompleto, id_xpert , loginName FROM ti_clientes
            WHERE id_xpert > 0 AND loginName IS NOT NULL AND inativo = 0 
            ORDER BY loginName");

        if ($sql->execute()) {
            $qry = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        $nomeMed = array(); // Inicialize o vetor


        foreach ($qry as $row) {
            $idMed = $row['id'];
            $idXpert = $row['id_xpert'];
            $loginName = $row['loginName'];

            $nomeMed[$idMed] = array(
                'idXpert' => $idXpert,
                'loginName' => $loginName
            );
        }


        return $nomeMed; // Retorna o vetor
    }
    public function getVetorDeMedsXpert()
    {
        $sql = $this->connection()->prepare("SELECT id, nomecompleto, id_xpert , loginName FROM ti_clientes
            WHERE id_xpert > 0 AND loginName IS NOT NULL AND inativo = 0 
            ORDER BY loginName");

        if ($sql->execute()) {
            $qry = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

      //  $nomeMed = array(); // Inicialize o vetor


        foreach ($qry as $row) {
            $idXpert = $row['id_xpert'];
            $loginName[$idXpert] = $row['loginName'];
        }


        return $loginName; // Retorna o vetor
    }
    public function getItemEValorManutencao()
    {

        $sql = $this->connection()->prepare("SELECT * FROM med_despesas_manutencao_item ORDER BY descricao");

        if ($sql->execute()) {
            $qry = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        $modalIncluirManutencao = array(); // Inicialize o vetor
        $itens = '';
        $itensValor = '';

        foreach ($qry as $row) {

            $itens .= '<option value="' . $row['id'] . '">' . $row['descricao'] . '</option>';
            $itensValor .= '<input type="hidden" id="' . $row['id'] . '" value="' . number_format($row['valor_unitario'], 2, ',', '.') . '">';
        }
        $modalIncluirManutencao = array(
            'itens' => $itens,
            'itensValor' => $itensValor
        );

        return $modalIncluirManutencao; // Retorna o vetor
    }
    public function produtoXpert($idProduto)
    {

        $produtoXpert[0] = 'PRODUTO';
        $produtoXpert[1] = 'GASOLINA C COMUM';
        $produtoXpert[2] = 'GASOLINA C ADITIVADA';
        $produtoXpert[3] = 'ETANOL';
        $produtoXpert[4] = 'OLEO DIESEL B S500';
        $produtoXpert[5] = 'OLEO DIESEL B S10';
        $produtoXpert[6] = 'GNV';

        return $produtoXpert[$idProduto];
    }
    public function produtosXpert(){
        $result = array();
    
        $sql = $this->connectionXpert()->prepare("SELECT DISTINCT ID_PRODUTOS, NOMEPRODUTO FROM PRODUTOS");
        $sql->execute();
        $qry = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($qry as $row) {
            $result[$row['ID_PRODUTOS']] = $row['NOMEPRODUTO'];
        }
    
        return $result;
    }
    public function nomeCidadeOrigem(){
        $result = array();
    
        $sql = $this->connection()->prepare("SELECT DISTINCT IdEntidade , CidadeEntidade FROM med_compras_xpertN WHERE NomeEntidade LIKE 'IPIRANGA%' ORDER BY CidadeEntidade");
        $sql->execute();
        $qry = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($qry as $row) {

            $result[$row['IdEntidade']] = $row['CidadeEntidade'];
        }
        $result[99] = 'ORIGEM';
        return $result;
    }

}