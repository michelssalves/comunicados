<?php

class ValidaLogin extends Conexao {


    public function __construct()
    {

    }
    public function selectUserById($id){ 
        
        $sql = $this->connection()->prepare("SELECT id, nomeCompleto, loginName FROM ti_clientes WHERE id = :id");
        $sql->bindParam('id', $id);
        $sql->execute();
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);

        return $usuario;
      
    }
    public function selectUserAcesso(){ 
        $id = array(
            84,
            92,
            161,
            211,
            2053
        );

       return $id; 
    }

}





















?>