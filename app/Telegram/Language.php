<?php

namespace App\Telegram;

use App\Models\TelegramUser;
use App\Models\TempMessage;
use App\Models\User;
use App\Telegram\Api\Client;
use App\Telegram\Commands\Start;

class Language extends Client
{

    public function askLanguage(Message $message)
    {
        $languages = [];
        foreach (config('telegram.languages') as $key => $lang) {
            $languages[] = array('text' => $key);
        }
        $response = $this->sendMessage($message->chat->id, '<b>Tilni Tanlang</b>', [
            'parse_mode' => 'html',
            'reply_markup' => json_encode([
                'keyboard' => [$languages],
                'resize_keyboard' => true
            ])
        ]);
        if ($response->ok) {
            TempMessage::query()->insert(['chat_id' => $response->result->chat->id, 'message_id' => $response->result->message_id]);
        }
    }

    public function setLanguage(Message $message, TelegramUser $user)
    {
        $user->update(['lang' => config('telegram.languages')[$message->text]]);

        TempMessage::query()->insert(['chat_id' => $message->chat->id, 'message_id' => $message->message_id]);

        $this->deleteTempMessages($message->chat->id);

        (new Start($this->bot))->handle($message);

    }

    private function deleteTempMessages($chat_id)
    {
        $temp_messages = TempMessage::query()->where('chat_id', $chat_id)->get();
        foreach ($temp_messages as $temp_message) {
            $this->deleteMessage($temp_message->chat_id, $temp_message->message_id);
        }
        TempMessage::query()->where('chat_id', $chat_id)->delete();
    }

}
