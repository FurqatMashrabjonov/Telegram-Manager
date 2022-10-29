<?php

namespace App\Telegram;

use App\Models\Bot;
use App\Telegram\Types\InlineKeyboardButton;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Handle
{

    public function __invoke(Bot $bot, Request $request)
    {
        $parsed = $this->parser($request->all()) . 'Handler';
        $this->$parsed($request);

        return true;
    }

    protected function parser($request)
    {
        if (isset($request['message'])) {
            if ($request['message']['text'][0] == '/') {
                return 'command';
            }
        } else if (isset($request['callback_query'])) {
            return 'callbackQuery';
        }
        return 'text';
    }

    //Handlers

    protected function commandHandler($request)
    {
        Log::debug('commanddan keldis');
        Http::get('https://api.telegram.org/bot2107607429:AAG2leDrFpRkGAbh9uP29kCxetYSCu4cuEM/sendMessage', [
                'chat_id' => $request['message']['chat']['id'],
                'text' => 'Command keldi'
            ]
        );
    }

    protected function textHandler($request)
    {
        Http::get('https://api.telegram.org/bot2107607429:AAG2leDrFpRkGAbh9uP29kCxetYSCu4cuEM/sendMessage', [
                'chat_id' => $request['message']['chat']['id'],
                'text' => 'Text keldi'
            ]
        );
    }

    protected function callbackQueryHandler($request)
    {
        Http::get('https://api.telegram.org/bot2107607429:AAG2leDrFpRkGAbh9uP29kCxetYSCu4cuEM/sendMessage', [
                'chat_id' => $request['callback_query']['message']['chat']['id'],
                'text' => 'Calback data keldi'
            ]
        );
    }


}










//        Http::get('https://api.telegram.org/bot2107607429:AAG2leDrFpRkGAbh9uP29kCxetYSCu4cuEM/sendMessage', [
//            'chat_id' => $request['message']['chat']['id'],
//            'text' => 'salommmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm',
//            'reply_markup' => json_encode([
//                    "inline_keyboard" => [
//                        [
//                            [
//                                "text" => "salom",
//                                "callback_data" => "itiscallback"
//                            ]
//                        ]
//                    ]
//                ]
//            )
//
//        ]);
