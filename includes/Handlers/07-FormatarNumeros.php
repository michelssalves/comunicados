<?php

class FormatarNumeros extends FormatarMenuSelect {

    public function v0($v)
    {
        if ($v) {
            return number_format($v, '0', ',', '.');
        }
    }
    public function v1($v)
    {
        if ($v) {
            return number_format($v, '1', ',', '.');
        }
    }
    public function v2($v)
    {
        if ($v) {
            return number_format($v, '2', ',', '.');
        }
    }
    function v2p($v) {
        return number_format($v, '2', '.', '');
    }
    public function v3($v)
    {
        if ($v) {
            return number_format($v, '3', ',', '.');
        }
    }
    public function v4($v)
    {
        if ($v) {
            return number_format($v, '4', ',', '.');
        }
    }
    public function v5($v)
    {
        if ($v) {
            return number_format($v, '5', ',', '.');
        }
    }
    public function v6($v)
    {
        if ($v) {
            return number_format($v, '6', ',', '.');
        }
    }
    public function v0USA($v)
    {
        if ($v) {
            return number_format($v, '0', '.', '');
        }
    }
    public function v1USA($v)
    {
        if ($v) {
            return number_format($v, '1', '.', '');
        }
    }
    public function v2USA($v)
    {
        if ($v) {
            return number_format($v, '2', '.', '');
        }
    }
    public function v3USA($v)
    {
        if ($v) {
            return number_format($v, '3', '.', '');
        }
    }
    public function v4USA($v)
    {
        if ($v) {
            return number_format($v, '4', '.', '');
        }
    }
    public function v0Grafico($v)
    {
        if ($v) {
            return number_format($v, '0', '', '');
        }
    }
    public function virgulaParaPonto($numero)
    {

        $numero = str_replace(",", ".", $numero);

        return $numero;
    }
    public function pontoParaVirgula($numero)
    {

        $numero = str_replace(".", ",", $numero);

        return $numero;
    }

}