<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Log;


class AvatarService
{
  protected $httpClient;
  protected $apiKey;


  public function __construct()
  {
    $this->httpClient = new Client();
    // $this->httpClient = new \GuzzleHttp\Client();
    $this->apiKey = env('STUDIO_ID_API_KEY');
  }



  public function getAvaters()
  {

    $response = $this->httpClient->request('GET', 'https://api.d-id.com/clips/presenters?limit=100', [
      'headers' => [
        'accept' => 'application/json',
        'authorization' => 'Bearer dmlja2VuNDA4QGdtYWlsLmNvbQ:D4I_uOYUUWwvYvUh6R7Cw',
      ],
    ]);

    echo $response->getBody();
  }
  public function getPresenterId($id)
  {
    $response = $this->httpClient->request('GET', 'https://api.d-id.com/clips/presenters/' . $id, [
      'headers' => [
        'accept' => 'application/json',
        'authorization' => 'Bearer dmlja2VuNDA4QGdtYWlsLmNvbQ:D4I_uOYUUWwvYvUh6R7Cw',
      ],
    ]);

    echo $response->getBody();
  }
  // public function creatClip()
  // {
  //   $response = $this->httpClient->request('POST', 'https://api.d-id.com/clips', [
  //     'body' => '{"script":{"type":"text","subtitles":"false","provider":{"type":"microsoft","voice_id":"en-US-JennyNeural"},"ssml":"false"},"config":{"result_format":"mp4"},"presenter_config":{"crop":{"type":"rectangle"}}}',
  //     'headers' => [
  //       'accept' => 'application/json',
  //       'authorization' => 'Bearer dmlja2VuNDA4QGdtYWlsLmNvbQ:D4I_uOYUUWwvYvUh6R7Cw',
  //       'content-type' => 'application/json',
  //     ],
  //   ]);

  //   echo $response->getBody();
  // }rian-lZC6MmWfC1
  public function creatClip($presenterId)
  {

    $response = $this->httpClient->request('POST', 'https://api.d-id.com/clips', [
      'body' => '{"script":{"type":"text","subtitles":false,"provider":{"type":"elevenlabs","voice_id":"21m00Tcm4TlvDq8ikWAM"},"ssml":"false","input":"This is it, how are you doing, i want to be your friend"},"config":{"result_format": "mp4"},"presenter_config":{"crop":{"type":"rectangle","rectangle":{"bottom":0,"right":0,"left":0,"top":0}}},"presenter_id": ' . $presenterId . '}',
      'headers' => [
        'accept' => 'application/json',
        'authorization' => 'Basic ZG1samEyVnVOREE0UUdkdFlXbHNMbU52YlE6dTFjZUpvUDM4eEFsU3hqZjB1a0Qz',
        'content-type' => 'application/json',
      ],
    ]);

    $jsonString = $response->getBody();

    $data = json_decode($jsonString, true);

    // Check if decoding was successful
    if ($data !== null) {
      // Access the 'id' field
      $id = $data['id'];
      return $id;
    } else {
      echo "Error decoding JSON";
    }
  }
  public function getOneClip($clip_d)
  {

    // dd($clip_d);
    $response = $this->httpClient->request('GET', 'https://api.d-id.com/clips/' . $clip_d, [
      'headers' => [
        'accept' => 'application/json',
        'authorization' => 'Basic ZG1samEyVnVOREE0UUdkdFlXbHNMbU52YlE6dTFjZUpvUDM4eEFsU3hqZjB1a0Qz',
      ],
    ]);

    echo $response->getBody() ;
  }
}
