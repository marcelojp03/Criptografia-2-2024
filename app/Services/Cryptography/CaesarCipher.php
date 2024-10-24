<?php
namespace App\Services\Cryptography;

class CaesarCipher
{
    public function encrypt($text, $shift): string
    {
        $result = '';
        $shift = $shift % 26; // Asegura que el shift esté en el rango de 0-25

        for ($i = 0; $i < strlen(string: $text); $i++) {
            $char = $text[$i];

            if (ctype_alpha(text: $char)) {
                $asciiOffset = ctype_upper(text: $char) ? ord(character: 'A') : ord(character: 'a');
                $char = chr(codepoint: (ord(character: $char) + $shift - $asciiOffset) % 26 + $asciiOffset);
            }

            $result .= $char;
        }

        return $result;
    }

    public function decrypt($text, $shift): string
    {
        return $this->encrypt(text: $text, shift: 26 - $shift);
    }
}
