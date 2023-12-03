<?php

namespace App\Jobs;

use App\Services\MailChimpService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SubscribeToMailchimpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $email,
    $key,
    $prefix,
    $listId;

    
    public function __construct($email, $key, $prefix, $listId)
    {
        $this->email = $email;
        $this->key = $key;
        $this->prefix = $prefix;
        $this->listId = $listId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mailchimp = app(MailChimpService::class);
        $mailchimp->subscribe($this->email, $this->key, $this->prefix ,$this->listId);
        // $mailchimp->deleteContact($this->email, $this->key, $this->prefix ,$this->listId);
        Log::info("Handling SubscribeToMailchimpJob for email: {$this->email}");
    }
}
