<?php

namespace App\Telegram\Types;

class InlineKeyboardButton
{
    /** @var string Label text on the button */
    public string $text;

    /** @var string|null HTTP or tg:// url to be opened when button is pressed */
    public ?string $url = null;


    /** @var string|null Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes */
    public ?string $callback_data = null;

    /** @var string|null If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot's username and the specified inline query in the input field. Can be empty, in which case just the bot's username will be inserted.Note: This offers an easy way for users to start using your bot in inline mode when they are currently in a private chat with it. Especially useful when combined with switch_pm… actions – in this case the user will be automatically returned to the chat they switched from, skipping the chat selection screen. */
    public ?string $switch_inline_query = null;

    /** @var string|null If set, pressing the button will insert the bot's username and the specified inline query in the current chat's input field. Can be empty, in which case only the bot's username will be inserted.This offers a quick way for the user to open your bot in inline mode in the same chat – good for selecting something from multiple options. */
    public ?string $switch_inline_query_current_chat = null;


    /** @var bool|null Specify True, to send a Pay button.NOTE: This type of button must always be the first button in the first row. */
    public ?bool $pay = null;

    public function __constructor($text, $url = null, $callback_data = null,){

    }

}
