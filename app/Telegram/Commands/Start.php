<?php

namespace App\Telegram\Commands;

use App\Telegram\Command;
use App\Telegram\Message;

class Start extends Command
{

    public function handle(Message $message)
    {
        $this->sendMessage($message->chat->id, 'Salom from Command: Start');
    }

}
