<?php

namespace App\Services;
// require_once('/path/to/MailchimpMarketing/vendor/autoload.php');
use MailchimpMarketing\ApiClient;
use Vendor\Package\ApiClient as MailchimpApiClient;
use MailchimpMarketing\ApiException; 
use Illuminate\Support\Facades\Crypt;




class MailChimpService
{

    public function getData()
    {
        $mailchimp = new \MailchimpMarketing\ApiClient();

        $mailchimp->setConfig([
            'apiKey' => 'e1f7a2e06cf128d61784d6b0db1a24f0-us21',
            'server' => 'us21'
        ]);

        $response = $mailchimp->ping->get();
        print_r($response);
    }

   
    public function subscribe($email, $apiKey, $prefixKey,$list_id)
    {
        $client = new \MailchimpMarketing\ApiClient();
        $client->setConfig([
            'apiKey' => $apiKey,
            // 'apiKey' => Crypt::decryptString($apiKey),
            'server' => $prefixKey,
        ]);

        try {
            $response = $client->lists->addListMember($list_id, [
                "email_address" => $email,
                "status" => "pending",
            ]);
            
        }catch (\Exception $e) {
            if (strpos($e->getMessage(), "Member Exists") !== false) {
            } else {
               
            }
        }
        

        // return $response; // Return the response if needed
    }

    public function getAllLists($apiKey, $prefixKey)
    {
        $client = new \MailchimpMarketing\ApiClient();
        $client->setConfig([
            'apiKey' => $apiKey,
            'server' => $prefixKey,
        ]);
    
        return $response = $client->lists->getAllLists();


     
    }
}
