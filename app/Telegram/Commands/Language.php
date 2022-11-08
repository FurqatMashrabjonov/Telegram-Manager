<?php

namespace App\Telegram\Commands;

use App\Telegram\Command;
use App\Telegram\Message;
use App\Telegram\ReplyMarkupMenu;
use function PHPUnit\Framework\returnArgument;

class Language extends Command
{

    public function handle(Message $message)
    {
        (new \App\Telegram\Language($this->bot))->askLanguage($message);
        return true;
    }

}
