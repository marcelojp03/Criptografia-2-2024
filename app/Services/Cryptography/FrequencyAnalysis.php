<?php
namespace App\Services\Cryptography;

class FrequencyAnalysis
{
    public function analyze($text)
    {
        $frequencies = [];
        $text = strtoupper($text);
        
        // Contar la frecuencia de cada letra
        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];
            if (ctype_alpha($char)) {
                if (!isset($frequencies[$char])) {
                    $frequencies[$char] = 0;
                }
                $frequencies[$char]++;
            }
        }
        // Ordenar por frecuencia
        arsort($frequencies);
        
        return $frequencies;
    }
}
