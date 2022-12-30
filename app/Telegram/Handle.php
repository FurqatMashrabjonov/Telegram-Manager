<?php

namespace App\Telegram;

use App\Models\Bot;
use App\Models\TelegramUser;
use App\Telegram\Handles\Menu\MainMenuHandler;
use App\Telegram\Handles\Menu\SettingsMenuHandler;
use Illuminate\Http\Request;
use Opcodes\LogViewer\Log;

class Handle
{

    public function __invoke($token, Request $request)
    {
        if (isset($request['ok']) && !$request['ok'])
            return false;

        $bot = Bot::query()->where('token', $token)->first();
        $user = $this->user($bot, $request->all());

        $parsed = $this->parser($request->all()) . 'Handler';
        $this->$parsed($bot, $request, $user);

        return true;
    }

    public function handle($token, $request): void
    {
//        if (isset($request['ok']) && !$request['ok'])
//            return false;

        $bot = Bot::query()->where('token', $token)->first();
        $user = $this->user($bot, $request);

        $parsed = $this->parser($request) . 'Handler';
        $this->$parsed($bot, $request, $user);
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
        $res = [];
        if (isset($request['callback_query'])) {
            $res['message'] = $request['callback_query']['message'];
            $res['from'] = $request['callback_query']['from'];
        } else if (isset($request['message'])) {
            $res['message'] = $request['message'];
            $res['from'] = $request['message']['from'];
        }

        $telegram_user = TelegramUser::query()
            ->where('bot_id', $bot->id)
            ->where('chat_id', $res['message']['chat']['id'])
            ->first();
        if ($telegram_user == null) {
            $telegram_user = $bot->users()->create(
                array_merge(
                    $res['from'],
                    [
                        'user_id' => $bot->user_id,
                        'chat_id' => $res['message']['chat']['id']
                    ]
                )
            );
        }
        return $telegram_user;
    }


    public function checkUserLang($user): bool
    {
        return $user->lang != null;
    }

    //Handlers

    protected function commandHandler($bot, $request, $user)
    {
        $hasLang = $this->checkUserLang($user);

        if (!$hasLang) {
            (new Language($bot))->askLanguage(new Message($request['message']));
            return true;
        }
        $handler = config('telegram.commands')[substr($request['message']['text'], 1)] ?? null;
        if ($handler != null) (new $handler($bot))->handle(new Message($request['message']));
    }

    protected function textHandler($bot, $request, $user)
    {
        if (array_key_exists($request['message']['text'], config('telegram.languages'))) {
            (new Language($bot))->setLanguage(new Message($request['message']), $user);
        } else if (array_key_exists($request['message']['text'], getMainMenuAsArray($user->lang))) {
            (new MainMenuHandler($bot, new Message($request['message']), $user))->{getMainMenuAsArray($user->lang)[$request['message']['text']]}(1, false);
        } else if (array_key_exists($request['message']['text'], getSettingsMenuAsArray($user->lang))) {
            (new SettingsMenuHandler($bot, new Message($request['message']), $user))->{getSettingsMenuAsArray($user->lang)[$request['message']['text']]}();
        }

    }

    protected function callbackQueryHandler($bot, $request, $user)
    {
        $handler = new MainMenuHandler($bot, new Message($request['callback_query']['message']), $user);

        if (str_contains($request['callback_query']['data'], 'categories')) {

            if (str_contains($request['callback_query']['data'], 'products_page')) {

                $parsed = explode('.', $request['callback_query']['data']);
                $category_id = (int)$parsed[1];
                $products_page = (int)$parsed[3];
                $handler->getProductsByCategory($category_id, $products_page, true);

            } else if (str_contains($request['callback_query']['data'], 'page')) {

                $handler->categories((int)explode('page.', $request['callback_query']['data'])[1], true);

            } else {

                $category_id = (int)explode('.', $request['callback_query']['data'])[1];
                $handler->getProductsByCategory($category_id, 1, false);

            }
        }
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
