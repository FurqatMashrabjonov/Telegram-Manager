<?php

namespace App\Telegram\Handles\Menu;

use App\Enums\ProductStatus;
use App\Models\Bot;
use App\Models\Category;
use App\Models\Product;
use App\Models\TelegramUser;
use App\Telegram\Api\Client;
use App\Telegram\Message;
use App\Telegram\ReplyMarkupMenu;
use App\Telegram\Traits\Pagination;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class SettingsMenuHandler extends Client
{

    use Pagination;

    public Message $message;
    public TelegramUser $user;

    public function __construct(Bot $bot, Message $message, TelegramUser $user)
    {
        $this->message = $message;
        $this->user = $user;

        parent::__construct($bot);

    }

    public function changeLanguage()
    {
        (new \App\Telegram\Language($this->bot))->askLanguage($this->message);
    }

}
