<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunicationController;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('message-form');
});

Route::post('/send-data', [CommunicationController::class, 'sendDataToPythonMiddleware']);
Route::get('/send-message-form', [CommunicationController::class, 'showMessageForm']);
Route::post('/send-message', [CommunicationController::class, 'sendMessage']);

// Ruta para manejar la respuesta de Flask
Route::post('/receive-response-from-flask', function (Request $request) {
    $response_from_flask = $request->input('message');
    
    // Imprimir el mensaje en la terminal de Laravel
    echo "Mensaje recibido desde Flask: $response_from_flask";
});