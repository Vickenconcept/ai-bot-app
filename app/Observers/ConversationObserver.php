<?php

// ConversationObserver.php

namespace App\Observers;

use App\Models\Conversation;
use App\Models\Bot;

class ConversationObserver
{
    public function creating(Conversation $conversation)
    {
        // Set a default bot if none is provided
        if (!$conversation->default_bot_id) {
            $defaultBot = Bot::where('name', true)->first();
            if ($defaultBot) {
                $conversation->default_bot_id = $defaultBot->id;
            }
        }
    }
}

