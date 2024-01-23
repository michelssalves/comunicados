<?php

class ValidaLogin extends Conexao {


    public function __construct()
    {

    }
    public function selectUserById($id){ 
        
        $sql = $this->connection()->prepare("SELECT id, nomeCompleto, loginName, isnull(id_xpert,0) AS idXpert, nivel_medweb, gerenteRede, apelido, email, controladorMed FROM ti_clientes WHERE id = :id");
        $sql->bindParam('id', $id);
        $sql->execute();
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
    
        if ($usuario['nivel_medweb'] == 2){
            $frede = "AND gerenteRede = " . $usuario['gerenteRede'];
            $usuario['frede'] = $frede;
        }
        
        if ($usuario['nivel_medweb'] == 24){
            $frede = "AND gerenteRede IN('6','2')";
            $usuario['frede'] = $frede;
        }
    
        if (intval($usuario['id']) >= 0){

            return $usuario;
        }
    
        return false;
    }

}





















?>