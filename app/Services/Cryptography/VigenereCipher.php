<?php
namespace App\Services\Cryptography;
class VigenereCipher
{
    public function encrypt($text, $key)
    {
        $result = '';
        $key = strtoupper($key);
        $keyLength = strlen($key);
        $textLength = strlen($text);
        
        for ($i = 0, $j = 0; $i < $textLength; $i++) {
            $char = $text[$i];
            if (ctype_alpha($char)) {
                $asciiOffset = ctype_upper($char) ? ord('A') : ord('a');
                $shift = ord($key[$j % $keyLength]) - ord('A');
                $result .= chr((ord($char) + $shift - $asciiOffset) % 26 + $asciiOffset);
                $j++;
            } else {
                $result .= $char;
            }
        }
        
        return $result;
    }

    public function decrypt($text, $key)
    {
        $result = '';
        $key = strtoupper($key);
        $keyLength = strlen($key);
        $textLength = strlen($text);
        
        for ($i = 0, $j = 0; $i < $textLength; $i++) {
            $char = $text[$i];
            if (ctype_alpha($char)) {
                $asciiOffset = ctype_upper($char) ? ord('A') : ord('a');
                $shift = ord($key[$j % $keyLength]) - ord('A');
                $result .= chr((ord($char) - $shift - $asciiOffset + 26) % 26 + $asciiOffset);
                $j++;
            } else {
                $result .= $char;
            }
        }
        
        return $result;
    }
}
