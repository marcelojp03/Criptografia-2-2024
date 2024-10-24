<?php
namespace App\Services\Cryptography;

class CaesarCipherCracker
{
    public function crack($ciphertext)
    {
        $results = [];
        for ($shift = 1; $shift <= 25; $shift++) {
            $results[$shift] = (new CaesarCipher())->decrypt($ciphertext, $shift);
        }
        return $results;
    }
}
