<?php

class EnvioDeEmail extends Botoes {

    
    private $dataHora;
    private $dataEnvio;
    private $autor = 'SISTEMA';
    private $autor2 = 'USUARIO';
    private $excluir = '0';
    public function __construct()
    {

        $this->dataHora = date('Y-m-d H:i:s');
        $this->dataEnvio = date('Y-m-d');
    }

    public function insertEnviarEmail($idAuth, $assunto, $mensagem, $enviado, $sistema)
    {

        $imagem = 'https://intranet.rdpenergia.com.br/intranet/img/GrupoRejaile.png';
        $idAuth = '219';

        $sql = $this->connection()->prepare("INSERT INTO envia_email (id_auth, assunto, mensagem, imagem, enviado, sistema, datahoracriacao) VALUES (:idAuth, :assunto, :mensagem, :imagem, :enviado, :sistema, :datahoracriacao)");
        $sql->bindValue('idAuth', $idAuth);
        $sql->bindValue('assunto', $assunto);
        $sql->bindValue('mensagem', $mensagem);
        $sql->bindValue('imagem', $imagem);
        $sql->bindValue('enviado', $enviado);
        $sql->bindValue('sistema', $sistema);
        $sql->bindValue('datahoracriacao', date('Y-m-d H:i'));

        if ($sql->execute()) {

            return true;
        }

        return false;
    }
    public function insertEnviarEmailDestinatario($idEmail,  $email, $nomeCompleto)
    {

        $sql = $this->connection()->prepare("INSERT INTO envia_email_destinatario (id_mensagem, endereco_email, descricao) VALUES (:idEmail, :email, :nomeCompleto)");

        $sql->bindValue('idEmail', $idEmail);
        $sql->bindValue('email', $email);
        $sql->bindValue('nomeCompleto', $nomeCompleto);

        if ($sql->execute()) {

            return true;
        }

        return false;
    }
    
}