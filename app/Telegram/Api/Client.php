<?php

namespace App\Telegram\Api;

use App\Models\Bot;
use GuzzleHttp\Client as C;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Client
{

    public Bot $bot;
    private C $client;
    private $base_url = "https://api.telegram.org";

    public function __construct(Bot $bot)
    {
        $this->bot = $bot;
        $this->client = new C(['base_uri' => 'https://api.telegram.org']);
    }

    private function call($method, $opts): mixed
    {
        $url = "/bot{$this->bot->token}/{$method}";
        $response = Http::get($this->base_url . $url, $opts);
        return json_decode($response->body());
    }

    public function sendMessage($chat_id, $text, $opts = [])
    {
       return $this->call('sendMessage', array_merge([
            'chat_id' => $chat_id,
            'text' => $text,
        ], $opts));
    }

    public function sendPhoto($chat_id, $photo_url, $opts = [])
    {
       return $this->call('sendPhoto', array_merge([
            'chat_id' => $chat_id,
            'photo' => $photo_url,
            'reply_markup' => [
                'inline_keyboard' => json_encode([
                    [
                        [
                            'text' => "Youtube",
                            'url' => 'https://youtube.com/c/FurqatMashrabjonov'
                        ]
                    ]
                ])
            ]
        ], $opts));
    }

    public function deleteMessage($chat_id, $message_id)
    {
        return $this->call('deleteMessage', [
            'chat_id' => $chat_id,
            'message_id' => $message_id
        ]);
    }

}
