<?php

namespace App\Telegram;

use App\Models\TelegramUser;
use App\Telegram\Api\Client;
use Illuminate\Support\Facades\Log;

class ReplyMarkupMenu extends Client
{

    protected TelegramUser $user;

    public function mainMenu(Message $message)
    {
        $user = TelegramUser::query()->where('chat_id', $message->chat->id)->where('bot_id', $this->bot->id)->first();

        $menu_button = config('telegram.menus')[$user->lang]['main_menu'];

        $this->sendMessage($message->chat->id, config('telegram.' . $user->lang)['welcome'], [
            'reply_markup' => json_encode(['keyboard' => $menu_button, 'resize_keyboard' => true])
        ]);
        return true;
    }

    public function settingsMenu(Message $message)
    {
        $user = TelegramUser::query()->where('chat_id', $message->chat->id)->where('bot_id', $this->bot->id)->first();

        $settings_menu_button = config('telegram.menus')[$user->lang]['settings_menu'];

        $this->sendMessage($message->chat->id, config('telegram.' . $user->lang)['settings'], [
            'reply_markup' => json_encode(['keyboard' => $settings_menu_button, 'resize_keyboard' => true])
        ]);
        return true;
    }
}
