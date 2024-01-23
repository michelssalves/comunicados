<?php

class FormatarTextos extends FormatarNumeros
{

    public function limpaTexto($observacao)
    {

        $observacao = strtoupper($observacao);

        $observacao = str_replace("'", " ", $observacao);
        $observacao = str_replace('"', " ", $observacao);
        $observacao = str_replace('>', " ", $observacao);
        $observacao = str_replace('<', " ", $observacao);
        $observacao = str_replace('<', " ", $observacao);
        $observacao = str_replace('�', "C", $observacao);
        $observacao = str_replace('�', "A", $observacao);
        $observacao = str_replace('�', "A", $observacao);
        $observacao = str_replace('�', "E", $observacao);
        $observacao = str_replace('�', "E", $observacao);
        $observacao = str_replace('�', "I", $observacao);
        $observacao = str_replace('�', "O", $observacao);
        $observacao = str_replace('�', "O", $observacao);
        $observacao = str_replace('�', "U", $observacao);


        $observacao = strtoupper($observacao);

        return $observacao;
    }
    public function filtraCNPJ($texto)
    {

        $texto = str_replace(".", "", $texto);
        $texto = str_replace('-', "", $texto);
        $texto = str_replace('/', "", $texto);
        return $texto;
    }
    public function converterUtf8($d)
    {

        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = $this->converterUtf8($v);
            }
        } else if (is_string($d)) {

            return utf8_encode($d);
        }
        return $d;
    }
    public function limparComBr($email){

        $novoEmail = str_replace(".com", "", strtolower($email));
        $novoEmail = str_replace(".br", "", strtolower($novoEmail));

        return $novoEmail;

    }
}