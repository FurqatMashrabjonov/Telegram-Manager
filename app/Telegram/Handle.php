<?php

namespace App\Telegram;

use App\Models\Bot;
use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Handle
{

    public function __invoke($token, Request $request)
    {
        $bot = Bot::query()->where('token', $token)->first();
        $this->user($bot, $request->all());
        $parsed = $this->parser($request->all()) . 'Handler';
        $this->$parsed($bot, $request);

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

    public function user($bot, $request)
    {
        $telegram_user = TelegramUser::query()
            ->where('bot_id', $bot->id)
            ->where('chat_id', $request['message']['chat']['id'])
            ->first();
        if ($telegram_user == null) {
            $bot->users()->create(
                array_merge(
                    $request['message']['from'],
                    [
                        'user_id' => $bot->user_id,
                        'chat_id' => $request['message']['chat']['id']
                    ]
                )
            );
        }

    }

    //Handlers

    protected function commandHandler($bot, $request)
    {
        $handler = config('telegram.commands')[substr($request['message']['text'], 1)] ?? null;
        if ($handler != null) (new $handler($bot))->handle(new Message($request['message']));
    }

    protected function textHandler($bot, $request)
    {
        Http::get('https://api.telegram.org/bot2107607429:AAG2leDrFpRkGAbh9uP29kCxetYSCu4cuEM/sendMessage', [
                'chat_id' => $request['message']['chat']['id'],
                'text' => 'Text keldi'
            ]
        );
    }

    protected function callbackQueryHandler($bot, $request)
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
