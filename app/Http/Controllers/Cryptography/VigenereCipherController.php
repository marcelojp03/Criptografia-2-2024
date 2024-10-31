<?php

namespace App\Http\Controllers\Cryptography;
use App\Http\Controllers\Controller;
use App\Services\Cryptography\VigenereCipher;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class VigenereCipherController extends Controller
{
    protected $vigenereCipher;

    public function __construct()
    {
        $this->vigenereCipher = new VigenereCipher(); 
    }

    public function encrypt(Request $request): JsonResponse
    {
        try {
            // Log para ver si los parámetros llegan correctamente

            Log::info(message: 'Request recibido', context: ['json' => $request]);

            Log::info(message: 'Encrypt request received', context: ['text' => $request->input(key: 'text'), 'key' => $request->input(key: 'key')]);

            $text = $request->input(key: 'text');
            $key = $request->input(key: 'key');

            $encryptedText = $this->vigenereCipher->encrypt(text: $text, key: $key);

            return response()->json(data: ['result' => $encryptedText]);

        } catch (\Exception $e) {
            // Registrar el error en el log de Laravel
            Log::error(message: 'Error in encrypt method: ' . $e->getMessage());

            return response()->json(data: ['error' => 'An error occurred while encrypting the text.'], status: 500);
        }
    }

    public function decrypt(Request $request): JsonResponse
    {
        try {
            // Log para ver si los parámetros llegan correctamente
            Log::info(message: 'Decrypt request received', context: ['text' => $request->input(key: 'text'), 'key' => $request->input(key: 'key')]);

            $text = $request->input(key: 'text');
            $key = $request->input(key: 'key');

            $decryptedText = $this->vigenereCipher->decrypt(text: $text, key: $key);

            return response()->json(data: ['result' => $decryptedText]);

        } catch (\Exception $e) {
            // Registrar el error en el log de Laravel
            Log::error(message: 'Error in decrypt method: ' . $e->getMessage());

            return response()->json(data: ['error' => 'An error occurred while decrypting the text.'], status: 500);
        }
    }
}
