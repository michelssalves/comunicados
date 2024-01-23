<?php

class FormatarDataHora extends FormatarCoresDoMenu
{

    public function mes($numero)
    {

        $mmm[1] = 'JAN';
        $mmm[2] = 'FEV';
        $mmm[3] = 'MAR';
        $mmm[4] = 'ABR';
        $mmm[5] = 'MAI';
        $mmm[6] = 'JUN';
        $mmm[7] = 'JUL';
        $mmm[8] = 'AGO';
        $mmm[9] = 'SET';
        $mmm[10] = 'OUT';
        $mmm[11] = 'NOV';
        $mmm[12] = 'DEZ';

        return $mmm[$numero];
    }
    public function formatarData($data)
    {

        $ano = date('Y', strtotime($data));
        $mes = $this->mes(intval(date('m', strtotime($data))));
        $resultado = "$mes-$ano";

        return $resultado;
    }
    public function hi($m)
    {
        if ($m) {
            $data = date('Hi', strtotime($m));
            return $data;
        }
    }  //converte yyyy-mm-aa para dd-mm-aaaa
    public function H_i($m)
    {
        if ($m) {
            $data = date('H:i', strtotime($m));
            return $data;
        }
    }  //converte yyyy-mm-aa para dd-mm-aaaa
    public function dma($m)
    {
        if ($m) {
            $data = date('d/m/Y', strtotime($m));
            return $data;
        }
    }  //converte yyyy-mm-aa para dd-mm-aaaa
    public function d($m)
    {
        if ($m) {
            $data = date('d', strtotime($m));
            return $data;
        }
    }  //converte yyyy-mm-aa para dd-mm-aaaa
    public function dm($m)
    {
        if ($m) {
            $data = date('d-m', strtotime($m));
            return $data;
        }
    }  //converte yyyy-mm-aa para dd-mm-aaaa
    public function Ymd($m)
    {
        if ($m) {
            $data = date('Y-m-d', strtotime($m));
            return $data;
        }
    }  //converte yyyy-mm-aa para dd-mm-aaaa
    public function dmH($m)
    {
        if ($m) {
            $data = date('d-m H:i', strtotime($m));
            return $data;
        }
    } //converte yyyy-mm-aa HH:ii para dd-mm-aaaa HH:ii
    public function dmaH($m)
    {
        if ($m) {
            $data = date('d/m/Y H:i', strtotime($m));
            return $data;
        }
    } //converte yyyy-mm-aa HH:ii para dd-mm-aaaa HH:ii
    public function diaSemana1($m)
    {
        $data = date('w', strtotime($m));
        return $data;
    } //converte yyyy-mm-aa HH:ii para dd-mm-aaaa HH:ii
    public function numeroDiaDaSemana($m)
    {
        $data = date('w', strtotime($m));
        return $data;
    } //converte yyyy-mm-aa HH:ii para dd-mm-aaaa HH:ii
    public function Y($m)
    {
        $data = date('Y', strtotime($m));
        return $data;
    } //converte yyyy-mm-aa HH:ii para aaaa
    public function m($m)
    {
        $data = date('m', strtotime($m));
        return $data;
    } //converte yyyy-mm-aa HH:ii para mm
    public function ma($m)
    {
        $data = date('m-Y', strtotime($m));
        return $data;
    } //converte yyyy-mm-aa HH:ii para mm
    public function int2hora($v)
    {
        if ($v) {
            $r = $v / 100;
            return str_pad(number_format($r, '2', ':', ''), 5, '0', STR_PAD_LEFT);
        }
    } //transforma numero em hora Ex. 630 em 06:30, usado para agendamento das Armazenadoras
    public function ultimoDia($m, $a)
    {
        return date("Y-m-t", mktime(0, 0, 0, $m, '01', $a));
    }
    //DIA DA SEMANA
    public function diaSemanaRdz($dia)
    {

        $diaSem[0] = 'DOM';
        $diaSem[1] = 'SEG';
        $diaSem[2] = 'TER';
        $diaSem[3] = 'QUA';
        $diaSem[4] = 'QUI';
        $diaSem[5] = 'SEX';
        $diaSem[6] = 'SAB';

        return  $diaSem[$dia];
    }
    public function diaSemana($dia)
    {

        $diaSem[0] = 'Domingo';
        $diaSem[1] = 'Segunda-Feira';
        $diaSem[2] = 'Terca-Feira';
        $diaSem[3] = 'Quarta-Feira';
        $diaSem[4] = 'Quinta-Feira';
        $diaSem[5] = 'Sexta-Feira';
        $diaSem[6] = 'Sabado';

        return  $diaSem[$dia];
    }
}
