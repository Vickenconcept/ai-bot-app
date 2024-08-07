<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;


class ChatGptService
{
    protected $httpClient;
    protected $apiKey;


    public function __construct($apiKey)
    {
        $this->httpClient = new Client();
        $this->apiKey = $apiKey;
    }



    public function generateContent($name, $model, $system, $prompt, $document, $lang = 'en')
    {
        $url = 'https://api.openai.com/v1/chat/completions';
        $maxRetries = 3;
        $retryDelay = 5; // seconds
        $prompt = substr($prompt, 0, 4096);
        // dd($prompt);

        for ($retry = 0; $retry < $maxRetries; $retry++) {
            try {
                $response = $this->httpClient->post($url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Content-Type' => 'application/json',
                    ],

                    'json' => [
                        // 'model' => 'gpt-4-1106-preview',
                        'model' => $model,
                        'messages' => [
                            ['role' => 'assistant', 'content' => $document],
                            ['role' => 'system', 'content' => $system . '. your name is ' . $name . ', responed in this ' . $lang . ' language only'],
                            ['role' => 'user', 'content' => $prompt],
                        ],
                        'temperature' => 0.2, // Adjust as needed
                    ],
                ]);

                $content = json_decode($response->getBody(), true)['choices'][0]['message']['content'];

                return $content;
            } catch (ClientException $e) {
                if ($e->getResponse()->getStatusCode() === 429) {
                    // Handle the 429 error (Too Many Requests)
                    if ($retry < $maxRetries - 1) {
                        Log::info("Rate limit exceeded. Retrying in {$retryDelay} seconds.");
                        sleep($retryDelay);
                    } else {
                        Log::error("API request failed: Rate limit exceeded after retries.");
                    }
                } else {
                    // Handle other errors
                    Log::error("API request failed: " . $e->getMessage());
                    break;
                }
            } catch (RequestException $e) {
                // Handle request exceptions
                if ($e->response->status() === 429) {
                    $errorResponse = $e->response->json(); // Get the error response from the API
                    $errorMessage = $errorResponse['error']['message']; // Extract the error message
                    return $errorMessage; // Return the error message
                    
                } else {
                    // Handle other HTTP status codes
                    // ...
                }
            } catch (\Exception $e) {
                // Handle the cURL error

                // Check if the error message contains "Could not resolve host"
                if (strpos($e->getMessage(), 'Could not resolve host') !== false) {
                    // Handle the "Could not resolve host" error

                    // For example, you can log the error or provide a custom error message
                    Log::error('cURL error: Could not resolve host');
                    // Or return a custom error response to the user
                    // return response()->json(['error' => 'Could not resolve host. Please try again later.'], 500);
                    return  'Connection error. Please try again later.';
                } elseif (strpos($e->getMessage(), 'cURL error 35') !== false) {
                    // Handle the SSL connection error

                    // For example, you can log the error or provide a custom error message
                    Log::error('cURL SSL connection error: ' . $e->getMessage());
                    // Or return a custom error response to the user
                    return 'Connection error. Please try again later.';
                    // return response()->json(['error' => 'There was an SSL connection error. Please try again later.'], 500);
                }


                throw $e;
            } catch (ConnectException $e) {
                return  'Connection error. Please try again later.';
            }
        }

        return null;
    }
}
