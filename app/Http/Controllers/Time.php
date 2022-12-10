<?php

namespace App\Http\Controllers;

class Time
{
    public function conversorSegundosHoras($tiempo_en_segundos)
    {
        $horas = floor($tiempo_en_segundos / 3600);
        $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
        $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

        $hora_texto = "";
        if ($horas > 0) {
            $hora_texto .= $horas . "h ";
        }

        if ($minutos > 0) {
            $hora_texto .= $minutos . "m ";
        }

        if ($segundos > 0) {
            $hora_texto .= $segundos . "s";
        }

        return $hora_texto;
    }
}
