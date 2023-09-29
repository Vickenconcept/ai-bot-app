<?php

namespace App\Http\Controllers;

use App\Models\Content;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;
use Symfony\Component\HttpFoundation\StreamedResponse;
use OpenAI\Api\Chat;

class AskController extends Controller
{
    public function __invoke(Request $request)
    {




        $openai = new Client();
 
        $prompt = $request->input('question');

     

        $response = $openai->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                // 'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a knowledgeable assistant that provides detailed explanations about topics.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.2, // Adjust as needed
            ],
        ]);

        $choices =  json_decode($response->getBody(), true)['choices'][0];

        $response = new StreamedResponse();
        Log::info('response info:', ['response' => $response]);
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('X-Accel-Buffering', 'no');

        // Stream the responses
        $response->setCallback(function () use ($choices) {
            echo "retry: 1000\n\n";
            $content = $choices['message']['content'];

            // Split the content into an array of words
            $words = explode(' ', $content);

            // Stream each word
            // foreach ($words as $word) {

            //     if (connection_aborted()) {
            //         break;
            //     }

            //     echo "data:  $word\n\n";
            //     echo "\n\n";
            //     ob_flush();
            //     flush();
            //     usleep(100000); // Delay for 100 milliseconds (adjust as needed)

            // }
            echo "data:  $content\n\n";
                echo "\n\n";
                ob_flush();
                flush();
                usleep(100000);

            echo "data: <END_STREAMING_SSE>\n\n";
            echo "\n\n";
            ob_flush();
            flush();
        });


        return $response;

























        // $question = $request->query('question');
        // return response()->stream(function () use ($question) {
        //     $stream = OpenAI::completions()->createStreamed([
        //         'model' => 'text-davinci-003',
        //         'prompt' => $question,
        //         'max_tokens' => 2000,
        //     ]);


        //     foreach ($stream as $response) {
        //         $text = $response->choices[0]->text;
        //         if (connection_aborted()) {
        //             break;
        //         }

        //         echo "event: update\n";
        //         echo 'data: ' . $text;
        //         echo "\n\n";
        //         ob_flush();
        //         flush();
        //     }

        //     echo "event: update\n";
        //     echo 'data: <END_STREAMING_SSE>';
        //     echo "\n\n";
        //     ob_flush();
        //     flush();
        // }, 200, [
        //     'Cache-Control' => 'no-cache',
        //     'X-Accel-Buffering' => 'no',
        //     'Content-Type' => 'text/event-stream',
        // ]);
    }
}
