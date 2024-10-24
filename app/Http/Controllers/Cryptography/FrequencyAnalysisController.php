<?php
namespace App\Http\Controllers\Cryptography;

use App\Http\Controllers\Controller;
use App\Services\Cryptography\FrequencyAnalysis;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class FrequencyAnalysisController extends Controller
{
    protected $frequencyAnalysis;

    public function __construct()
    {
        $this->frequencyAnalysis = new FrequencyAnalysis(); 
    }

    public function analyze(Request $request): JsonResponse
    {
        try {
            // Log para ver si los parámetros llegan correctamente
            Log::info(message: 'Text request received', context: ['text' => $request->input(key: 'text')]);

            $text = $request->input(key: 'text');

            $frequencies = $this->frequencyAnalysis->analyze(text: $text);

            return response()->json(data: ['frequencies' => $frequencies]);

        } catch (\Exception $e) {
            // Registrar el error en el log de Laravel
            Log::error(message: 'Error in frequency method: ' . $e->getMessage());

            return response()->json(data: ['error' => 'An error occurred while obtaining text frequencies.'], status: 500);
        }
    }
}