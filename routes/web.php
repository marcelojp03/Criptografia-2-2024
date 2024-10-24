<?php

use Illuminate\Support\Facades\Route;
use Carbon\Factory;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Cryptography\CaesarCipherController;
use App\Http\Controllers\Cryptography\VigenereCipherController;
use App\Http\Controllers\Cryptography\ColumnarTranspositionController;
use App\Http\Controllers\Cryptography\FrequencyAnalysisController;
use App\Http\Controllers\Cryptography\CaesarCipherCrackerController;


Route::get(uri: '/', action: function (): Factory|View {
    return view(view: 'welcome');
});

Route::get(uri: '/token', action: function (): string {
    return csrf_token(); 
});

Route::post(uri: '/api/caesar/encrypt', action: [CaesarCipherController::class, 'encrypt']);
Route::post(uri: '/api/caesar/decrypt', action: [CaesarCipherController::class, 'decrypt']);

Route::post(uri: '/api/vigenere/encrypt', action: [VigenereCipherController::class, 'encrypt']);
Route::post(uri: '/api/vigenere/decrypt', action: [VigenereCipherController::class, 'decrypt']);

Route::post(uri: '/api/columnar-tranposition/encrypt', action: [ColumnarTranspositionController::class, 'encrypt']);
Route::post(uri: '/api/columnar-tranposition/decrypt', action: [ColumnarTranspositionController::class, 'decrypt']);


Route::post(uri: '/api/frequency-analysis/analyze', action: [FrequencyAnalysisController::class, 'analyze']);

Route::post(uri: '/api/ccc/crack', action: [CaesarCipherCrackerController::class, 'crack']);


