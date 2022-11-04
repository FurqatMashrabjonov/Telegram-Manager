<?php

namespace App\Telegram\Handles\Menu;

use App\Models\Bot;
use App\Models\Category;
use App\Models\TelegramUser;
use App\Telegram\Api\Client;
use App\Telegram\Message;
use App\Telegram\Traits\Pagination;
use Illuminate\Support\Facades\Log;

class MainMenuHandler extends Client
{

    use Pagination;

    public function products(Message $message, TelegramUser $user)
    {

    }

    public function categories(Message $message, TelegramUser $user, $page = 1)
    {
        $this->sendMessage($message->chat->id, config('telegram.' . $user->lang)['categories'], [
            'reply_markup' => json_encode([
                'inline_keyboard' => $this->categoryPagination($page)
            ])
        ]);
    }

    public function settings(Message $message, TelegramUser $user)
    {

    }

    public function orders(Message $message, TelegramUser $user)
    {

    }

}
