<?php
class Comunicados extends Funcoes
{
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
    public function getGrupos($usuario)
    {

        $sql = $this->connection()->prepare("SELECT id_grupo FROM noticias_grupos WHERE id_usuario = :id");
        $sql->bindValue(':id', $usuario['id']);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_COLUMN);
        if (!empty($data)) {
            $formattedData = implode(',', $data);
            $formattedString = "AND id_grupo IN($formattedData)";

            return $formattedString;
        }

        return '';

    }
    public function getNoticiasById($idNoticia)
    {

        $sql = $this->connection()->prepare("SELECT * FROM noticias_rdp WHERE id_noticia = :idNoticia");
        $sql->bindParam(':idNoticia', $idNoticia);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
    public function getNoticiasByGrupo($grupo, $usuario)
    {

        $sql = $this->connection()->prepare("SELECT nr.titulo, nr.data_noticia, nr.id_noticia,
        (SELECT count(id_noticia) as qtde FROM noticias_lidas WHERE id_usuario = :id AND id_noticia = nr.id_noticia) AS lido
        FROM noticias_rdp AS nr
        WHERE nr.id_noticia IN (SELECT nl.id_noticia FROM noticias_ligacao as nl WHERE categoria IS NULL $grupo) AND nr.categoria = 'ativa'");
        $sql->bindParam(':id', $usuario['id']);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
    public function getNoticiasLidas($idNoticia, $idUsuario)
    {

        $sql = $this->connection()->prepare("SELECT * FROM noticias_lidas WHERE id_noticia = :idNoticia AND id_usuario = :idUsuario AND categoria IS NULL");
        $sql->bindParam(':idNoticia', $idNoticia);
        $sql->bindParam(':idUsuario', $idUsuario);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        $rowCount = count($data);
        return $rowCount;
    }
    public function menuSelectGrupos()
    {

        $sql = $this->connection()->prepare("SELECT DISTINCT(IL.id), IL.descricao FROM inventario_local AS IL
        JOIN noticias_grupos AS NG
        ON IL.id = NG.id_grupo
        WHERE grupo_status > 0 AND IL.STATUS = 0
        ORDER BY descricao");
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $row) {

            $cbGrupo .= '<li style="cursor:pointer;"><input style="cursor:pointer; padding:15px" type="checkbox" name="grupos[]" value="' . $row['id'] . '" /><span style="margin-left:10px">' . $row['descricao'] . '</span></li>';
        }

        return $cbGrupo;

    }
    public function menuSelectEmails()
    {

        $sql = $this->connection()->prepare("SELECT * FROM ti_clientes ORDER BY email");
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $row) {

            $cbEmails .= '<li style="cursor:pointer;"><input style="cursor:pointer; padding:15px" type="checkbox" name="emails[]" value="' . $row['id'] . '" /><span style="margin-left:10px">' . $this->limparComBr($row['email']) . '</span></li>';
        }

        return $cbEmails;

    }
    public function registrarVisualizacao($id, $idNoticia, $idGrupo)
    {
        try {
            $sql = $this->connection()->prepare("INSERT INTO noticias_lidas (id_usuario, id_noticia, data_visualizacao, id_grupo) 
            VALUES (:id, :idNoticia, :hoje, :idGrupo)");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':idNoticia', $idNoticia);
            $sql->bindValue(':hoje', $this->dataEnvio);
            $sql->bindValue(':idGrupo', $idGrupo);
            $sql->execute();

            return "<script>console.log('registrarVisualizacao Gravada com sucesso')</script>";

        } catch (PDOException $e) {

            return "<script>console.log('Erro na execução da consulta: ".$e->getMessage()."')</script>";
        }
     
    }
    public function insertComunicado($dados, $idGrupos, $usuario, $nomeArquivo)
    {
        if($dados['redirecionamento'] != ''){

           $redirecionamento = '<script>window.onload = function() {window.location.href ="'.$dados['redirecionamento'].'"; };</script>';
        }else{

           $redirecionamento = $dados['redirecionamento'];
        }

        try {
            $sql = $this->connection()->prepare("INSERT INTO noticias_rdp (titulo, categoria, data_noticia, texto, fonte, imagem_inicio, autor, id_grupo, texto_capa)
                                   VALUES (:titulo, :categoria, :dataCriacao, :noticia, :fonte, :nomeArquivo, :usuario, :grupo, :redirecionamento)");
            $sql->bindValue(':titulo', $dados["titulo"]);
            $sql->bindValue(':categoria', 'ativa');
            $sql->bindValue(':dataCriacao', $this->dataEnvio);
            $sql->bindValue(':noticia', htmlspecialchars($dados['noticia']));
            $sql->bindValue(':fonte', $dados['fonte']);
            $sql->bindValue(':nomeArquivo', $nomeArquivo);
            $sql->bindValue(':usuario', $usuario);
            $sql->bindValue(':grupo', $idGrupos);
            $sql->bindValue(':redirecionamento', $redirecionamento);
            $sql->execute();

            return "<script>alert('Cadastrado com sucesso!')</script>";

        } catch (PDOException $e) {

            return "<script>console.log('Erro na execução da consulta: ".$e->getMessage()."')</script>";
        }

    }
    public function insertNoticiaLigacao($grupo,$idNoticia)
    {

        try {

            $sql = $this->connection()->prepare("INSERT INTO noticias_ligacao (id_grupo, id_noticia) VALUES (:grupo, :idNoticia)");
            $sql->bindValue(':grupo', $grupo);
            $sql->bindValue(':idNoticia', $idNoticia);
            $sql->execute();

            return "<script>console.log('insertNoticiaLigacao realizada com sucesso!')</script>";

        } catch (PDOException $e) {

            return "<script>console.log('Erro na execução da consulta: ".$e->getMessage()."')</script>";

        }
    }
    public function insertGrupo($idGrupos, $idNoticia)
    {

        $sql = $this->connection()->prepare("INSERT INTO noticias_ligacao (id_grupo, id_noticia) VALUES (:idGrupos, :idNoticia)");
        $sql->bindValue(':idGrupos', $idGrupos);
        $sql->bindValue(':idNoticia', $idNoticia);
        $sql->execute();

    }
    public function listarGrupos()
    {

        $sql = $this->connection()->prepare("SELECT TC.email, IL.descricao, NG.id_grp FROM noticias_grupos AS NG
        JOIN inventario_local AS IL
        ON IL.id = NG.id_grupo
        JOIN ti_clientes AS TC
        ON NG.id_usuario = TC.id
        WHERE grupo_status > 0
        ORDER BY descricao");
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
    public function incluirNoGrupo($idUsuario, $grupo)
    {

        $sql = $this->connection()->prepare("INSERT INTO noticias_grupos (id_usuario, id_grupo, grupo_status) VALUES (:idUsuario, :idGrupo, :grupoStatus)");
        $sql->bindValue(':idUsuario', $idUsuario);
        $sql->bindValue(':idGrupo', $grupo);
        $sql->bindValue(':grupoStatus', 1);
        $sql->execute();

    }
    public function excluirDoGrupo($dados)
    {

        $sql = $this->connection()->prepare("DELETE FROM noticias_grupos WHERE id_grp = :idGrupo");
        $sql->bindValue(':idGrupo', $dados['id']);
        $sql->execute();

    }

    private function updateNoticiasLidas($noticia){

        try{ 
            $sql = $this->connection()->prepare("UPDATE noticias_lidas SET categoria = :categoria WHERE id_noticia = :noticia");
            $sql->bindValue(':noticia', $noticia);
            $sql->execute();
            return "<script>console.log('Realizado updateNoticiasLidas')</script>";

        } catch (PDOException $e) {

            return "<script>console.log('Erro na execução da consulta: ".$e->getMessage()."')</script>";

        }
 
    }
    private function updateNoticiasLigacao($noticia){

        try{ 
            $sql = $this->connection()->prepare("UPDATE noticias_ligacao SET categoria = :categoria WHERE id_noticia = :noticia");
            $sql->bindValue(':noticia', $noticia);
            $sql->execute();
            return "<script>console.log('Realizado updateNoticiasLigacao')</script>";

        } catch (PDOException $e) {

            return "<script>console.log('Erro na execução da consulta: ".$e->getMessage()."')</script>";

        }
      
    }
    private function updateNoticias($noticia){
       try{ 
            $sql = $this->connection()->prepare("UPDATE noticias_rdp SET categoria = :categoria WHERE id_noticia = :noticia");
            $sql->bindValue(':noticia', $noticia);
            $sql->bindValue(':categoria', 'excluido');
            $sql->execute();
            return "<script>console.log('Realizado updateNoticias')</script>";

        } catch (PDOException $e) {

            return "<script>console.log('Erro na execução da consulta: ".$e->getMessage()."')</script>";

        }
       
    }

    public function deleteNoticia($noticia){

       $m1 = $this->updateNoticias($noticia);
       $m2 = $this->updateNoticiasLigacao($noticia);
       $m3 = $this->updateNoticiasLidas($noticia);
       $msg = "$m1 $m2 $m3";
       return $msg;
    
    }
}
