<?php

namespace App\Telegram;

use App\Models\TelegramUser;
use App\Models\User;
use App\Telegram\Api\Client;

class Language extends Client
{

    public function askLanguage(Message $message)
    {
        $languages = [];
        foreach (config('telegram.languages') as $key => $lang) {
            $languages[] = array('text' => $key);
        }
        $this->sendMessage($message->chat->id, '<b>Tilni Tanlang</b>', [
            'parse_mode' => 'html',
            'reply_markup' => json_encode([
                'keyboard' => [$languages],
                'resize_keyboard' => true
            ])
        ]);
    }

    public function setLanguage(Message $message, TelegramUser $user)
    {
        $user->update(['lang' => config('telegram.languages')[$message->text]]);
        $this->sendMessage($message->chat->id, $user->first_name);
    }

}
