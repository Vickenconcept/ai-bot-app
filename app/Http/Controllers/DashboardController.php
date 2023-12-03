<?php

namespace App\Http\Controllers;

use App\Jobs\SubscribeToMailchimpJob;
use App\Models\Conversation;
use App\Services\MailChimpService;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $usersContacts = Conversation::where('type', 'guest')->latest()->get();
        $user = auth()->user()->mailchimp;
        $mailchimpData = json_decode($user);
        
        $errorMessage = null;
            $mailchimp = app(MailChimpService::class);
            if ($mailchimpData) {
                $mailLists = $mailchimp->getAllLists($mailchimpData->api_key, $mailchimpData->prefix);
               
            } else {
                $mailLists = null;
            }

            if (!$mailLists == []) {

                return view('dashboard', compact('usersContacts', 'mailchimpData', 'mailLists','errorMessage'));
            }elseif($mailLists === null){
                $errorMessage = 'Submit Mailchimp Credentials';
                
                return view('dashboard', compact('usersContacts', 'mailchimpData', 'mailLists','errorMessage'));
            }
            else {
                $errorMessage = 'Incorrect Mailchimp Credentials';
                
                return view('dashboard', compact('usersContacts', 'mailchimpData', 'mailLists','errorMessage'));
            }
            
    }
    public function store(Request $request)
    {
        $api_key = $request->input('api_key');
        $prefix = $request->input('prefix');

        $request->validate([
            'api_key' => 'required',
            'prefix' => 'required'
        ]);

        $data = [
            'api_key' => $api_key,
            'prefix' => $prefix
        ];

        $user = auth()->user();
        $user->mailchimp = json_encode($data);
        $user->update();

        return redirect()->back()->with('success', 'updated successfully');
    }

    public function subscribe(Request $request)
    {

        $mailchimp = app(MailChimpService::class);
        $contentId = $request->input('contentId');
        $listId = $request->input('listId');

        $user = auth()->user()->mailchimp;
        $mailchimpData = json_decode($user);

        $usersContacts = Conversation::find($contentId);

        $emails = [];

        foreach ($usersContacts->users_contact_info as $value) {
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $emails[] = $value;
            }
        }

        foreach ($emails as $email) {
            dispatch(new SubscribeToMailchimpJob($email, $mailchimpData->api_key, $mailchimpData->prefix, $listId));
        }
        return back()->with('success', 'subscription sent');
    }
}
