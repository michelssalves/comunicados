<?php

class Handlers extends ValidaLogin{

    public function __construct()
    {
    }
    public function getUltimoId($tabela, $campo)
    {

        $sql = $this->connection()->prepare("SELECT TOP 1 $campo FROM $tabela ORDER BY $campo DESC");
        if ($sql->execute()) {
            $qry = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        foreach($qry as $row){

            $ultimoId = $row["$campo"];
        }

        return $ultimoId;
    }
    
    public function anexarArquivos($temp, $ultimoId, $arquivo, $localDeArmazenagem)
    {

        //return var_dump($_FILES);
        //pdf //plain -> txt //vnd.ms-excel -> excel
        $extensao = strtolower(end(explode('/',  $arquivo['type'])));
        $nomeDoArquivo = "$ultimoId.$extensao";
        $arquivo['extensoes'] = array('pdf', 'PDF', 'jpg', 'JPG', 'png', 'PNG','doc', 'DOC', 'xls', 'XLS', 'docx', 'DOCX', 'xlsx', 'XLSX');

        if (in_array($extensao, $arquivo['extensoes'])) {

            if (move_uploaded_file($temp, $localDeArmazenagem . $nomeDoArquivo)) {

                return true;
            } else {

                $msg = "Não foi possível fazer o upload, erro:";
                return $msg;
            }
        } else {

            $msg = "Extensão inválida!";
            return $msg;
        }
    }
    public function converterUtf8($d) {

        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = $this->converterUtf8($v);
            }
        } else if (is_string ($d)) {

            return utf8_encode($d);
        }
        return $d;
    }
    public function filtraCNPJ($texto){
        $texto = str_replace(".", "", $texto);	
        $texto = str_replace('-', "", $texto);$texto = str_replace('/', "", $texto);return $texto;}
    public function cpf($texto){$texto = $this->filtraCNPJ($texto);	$texto = substr($texto,0,3).'.'.substr($texto,3,3).'.'.substr($texto,6,3).'-'.substr($texto,9,2);return $texto;}
    public function rg($texto) {$texto = $this->filtraCNPJ($texto);	$texto = substr($texto,0,1).'.'.substr($texto,1,3).'.'.substr($texto,4,3).'-'.substr($texto,7,1);return $texto;}
    public function filtraSQL($texto) {$texto = str_replace("'", "´", $texto); return $texto; }
    public function filtraSQLM($texto) {$texto = str_replace("'", "´", $texto); return strtoupper($texto); }
    
}