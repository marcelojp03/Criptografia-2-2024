<?php
namespace App\Http\Controllers\Cryptography;

use App\Http\Controllers\Controller;
use App\Services\Cryptography\CaesarCipherCracker;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CaesarCipherCrackerController extends Controller
{
    protected $caesarCipherCracker;

    public function __construct()
    {
        $this->caesarCipherCracker = new CaesarCipherCracker(); 
    }

    public function crack(Request $request): JsonResponse
    {
        try {
            // Log para ver si los parámetros llegan correctamente
            Log::info(message: 'Text request received', context: ['text' => $request->input(key: 'text')]);

            $text = $request->input(key: 'text');

            $results = $this->caesarCipherCracker->crack( $text);

            return response()->json(data: ['results' => $results]);

        } catch (\Exception $e) {
            // Registrar el error en el log de Laravel
            Log::error(message: 'Error in crack method: ' . $e->getMessage());

            return response()->json(data: ['error' => 'An error occurred while obtaining text results.'], status: 500);
        }
    }
}