<?php
namespace App\Services\Cryptography;

class CaesarCipher
{
    protected $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function encrypt($text, $shift): string
    {
        $result = '';
        $shift = $shift % strlen($this->alphabet); // Asegura que el shift esté en el rango de 0-25

        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];

            if (ctype_alpha($char)) {
                // Determina el offset basado en si la letra es mayúscula o minúscula
                $asciiOffset = ctype_upper($char) ? ord('A') : ord('a');
                // Realiza el cifrado
                $char = chr((ord($char) + $shift - $asciiOffset) % 26 + $asciiOffset);
            }

            $result .= $char;
        }

        return $result;
    }

    public function decrypt($text, $shift): string
    {
        return $this->encrypt($text, 26 - ($shift % 26)); // Desplazamiento inverso
    }
}
