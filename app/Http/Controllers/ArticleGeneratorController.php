<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use OpenAI\Laravel\Facades\OpenAI;
use OpenAI;



class ArticleGeneratorController extends Controller
{

    public function index(Request $request) {

        $valor = $request->valor;
        $cuotas = $request->cuota;
        $tipoCredido = $request->tipocredito;

        // $client = OpenAI::client(env('OPENAI_API_KEY'));
        $client = OpenAI::client(config('app.openai_api_key'));
        $title = "Rabbit";

        $result = $client->completions()->create([
            "model" => "gpt-3.5-turbo",
            "temperature" => 0.7,
            "top_p" => 1,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
            'max_tokens' => 600,
            'prompt' => sprintf('Write article about: %s', $title),
        ]);
    
        $content = trim($result['choices'][0]['text']);
        return view('writer', compact('title', 'content'));
    }

    public function getOpenAIResponse()
    {
        $apiKey = config('app.openai_api_key');
   
        $response = Http::post('https://api.openai.com/v1/chat/completions', [
            'prompt' => 'Escribe tu prompt aquí',
        ], [
            'Authorization' => 'Bearer ' . $apiKey,
        ]);

        $result = $response->json();
        return response()->json($result);
    }

    public function chat(Request $request) {

        $valor = $request->valor;
        $cuotas = $request->cuota;
        $tipoCredido = $request->tipocredito;

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Hello!'
                ],
            ],
        ]);
        echo $result->choices[0]->message->content;

    }

    public function submit(Request $request) {

        $valor = $request->valor;
        $cuotas = $request->cuota;
        $tipoCredido = $request->tipocredito;

        $client = OpenAI::client(env("OPENAI_API_KEY"));

        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                'role' => 'user', 
                'content' => "Calcular el valor mensual de un credito con la siguiente operacion " .
                 ($valor/$cuotas) + $tipoCredido
            ]
        ]);

        $content = $response->choices[0]->message->content;

        return view('writer', compact('content'));

    }


}
