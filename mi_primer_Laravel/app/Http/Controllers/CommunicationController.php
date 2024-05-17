<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommunicationController extends Controller
{
    public function showMessageForm()
    {
        return view('message-form');
    }
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        // Envía el mensaje a Flask
        $response = Http::post('https://dh3c1ztc-5001.use2.devtunnels.ms/api/from_laravel', ['message' => $message]);

        // Procesa la respuesta si es necesario

        // Redirecciona o muestra algún mensaje de éxito
        return redirect('/')->with('success', 'Mensaje enviado correctamente');
    }
    
    public function sendDataToPythonMiddleware(Request $request)
    {
        // Datos a enviar al servidor Flask
        $data = ['message' => 'Hola desde Laravel'];

        // Envía los datos al servidor Flask y obtén la respuesta
        $response = Http::post('https://dh3c1ztc-5001.use2.devtunnels.ms/api/from_laravel', $data);

        // Procesa la respuesta recibida del servidor Flask
        $responseData = $response->json();

        // Muestra la respuesta en la vista o realiza cualquier otra acción necesaria
        return response()->json(['response_from_flask' => $responseData]);
    }
}