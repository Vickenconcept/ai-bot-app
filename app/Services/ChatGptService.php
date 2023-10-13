<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;


class ChatGptService
{
    protected $httpClient;
    protected $apiKey;


    public function __construct($apiKey)
    {
        $this->httpClient = new Client();
        $this->apiKey = $apiKey;
    }

  

    public function generateContent($name, $model, $system, $prompt)
    {
        $url = 'https://api.openai.com/v1/chat/completions';
        $maxRetries = 3;
        $retryDelay = 5; // seconds

        for ($retry = 0; $retry < $maxRetries; $retry++) {
            try {
                $response = $this->httpClient->post($url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'model' => $model,
                        'messages' => [
                            ['role' => 'system', 'content' => $system .'. your name is '. $name],
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

                }  
                
                else {
                    // Handle other errors
                    Log::error("API request failed: " . $e->getMessage());
                    break;
                }
            }
            catch (\Exception $e) {
                // Handle the cURL error
            
                // Check if the error message contains "Could not resolve host"
                if (strpos($e->getMessage(), 'Could not resolve host') !== false) {
                    // Handle the "Could not resolve host" error
            
                    // For example, you can log the error or provide a custom error message
                    Log::error('cURL error: Could not resolve host');
                    // Or return a custom error response to the user
                    // return response()->json(['error' => 'Could not resolve host. Please try again later.'], 500);
                    return  'Connection error. Please try again later.';
                }elseif (strpos($e->getMessage(), 'cURL error 35') !== false) {
                    // Handle the SSL connection error
            
                    // For example, you can log the error or provide a custom error message
                    Log::error('cURL SSL connection error: ' . $e->getMessage());
                    // Or return a custom error response to the user
                    return 'Connection error. Please try again later.';
                    // return response()->json(['error' => 'There was an SSL connection error. Please try again later.'], 500);
                }
            
                // Handle other exceptions
                // ...
            
                // Rethrow the exception if it's not the specific error you want to handle
                throw $e;
            }
        }

        return null; 
    }





}