<?php

namespace App\Services;
// require_once('/path/to/MailchimpMarketing/vendor/autoload.php');

use GuzzleHttp\Exception\RequestException;
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


    public function subscribe($email, $apiKey, $prefixKey, $list_id)
    {
        $client = new \MailchimpMarketing\ApiClient();
        $client->setConfig([
            'apiKey' => $apiKey,
            'server' => $prefixKey,
        ]);

        try {
        // $response = $client->lists->addListMember($list_id, [
        //     "email_address" => $email,
        //     "status" => "pending",
        // ]);
        
        $response = $client->lists->setListMember($list_id, $email, [
            "email_address" => $email,
            "status_if_new" => "subscribed",
            "status" => "subscribed",
        ]);
        // dd($response);

        }
        catch (\Exception $e) {
            if (strpos($e->getMessage(), "Member Exists") !== false) {
            } else {

            }
        }

    }

    public function getAllLists($apiKey, $prefixKey)
    {
        try {
            $client = new \MailchimpMarketing\ApiClient();
            $client->setConfig([
                'apiKey' => $apiKey,
                'server' => $prefixKey,
            ]);
    
            return $response = $client->lists->getAllLists();
            //code...
        } catch (\Exception $e) {
           
            return [];
        
        }

    }
    public function deleteContact($email,$apiKey, $prefixKey, $list_id)
    {
        $client = new \MailchimpMarketing\ApiClient();
        $client->setConfig([
            'apiKey' => $apiKey,
            'server' => $prefixKey,
        ]);

        $response = $client->lists->deleteListMember($list_id, $email);
        print_r($response);

        return $response = $client->lists->getAllLists();
    }
}
