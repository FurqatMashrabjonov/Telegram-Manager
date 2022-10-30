<?php

namespace App\Telegram\Commands;

use App\Telegram\Command;
use App\Telegram\Message;

class Start extends Command
{

    public function handle(Message $message)
    {
        $this->sendMessage($message->chat->id, 'Salom from Command: Start');
        $this->sendPhoto($message->chat->id, 'https://content.freelancehunt.com/profile/photo/225/FurqatMashrabjonov.png', [
            'caption' => "Furqat Mashrabjonov",
            'reply_markup' => json_encode(
                [
                    'inline_keyboard' => [
                        [
                            [
                                "text" => "aaaaaaaaaaaaa",
                                "url" => "https://youtube.com"
                            ]
                        ]
                    ]
                ]
            )
        ]);
    }

}
