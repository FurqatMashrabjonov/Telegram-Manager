<?php

namespace App\Telegram\Commands;

use App\Telegram\Command;
use App\Telegram\Message;
use App\Telegram\ReplyMarkupMenu;
use function PHPUnit\Framework\returnArgument;

class Start extends Command
{

    public function handle(Message $message)
    {
        return (new ReplyMarkupMenu($this->bot))->mainMenu($message);
    }

}
