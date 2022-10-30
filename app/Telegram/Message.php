<?php

namespace App\Telegram;

use App\Telegram\Types\Chat;

class Message
{

    public function __construct($message)
    {
        $this->text = $message['text'];
        $this->from = $message['from'];
        $this->chat = new Chat($message['chat']);
        $this->message_id = $message['message_id'];
    }

    /** @var int Unique message identifier inside this chat */
    public int $message_id;

    /** @var null Sender, empty for messages sent to channels */
    public $from = null;

    /** @var null Sender of the message, sent on behalf of a chat. The channel itself for channel messages. The supergroup itself for messages from anonymous group administrators. The linked channel for messages automatically forwarded to the discussion group */
    public $sender_chat = null;

    /** @var int Date the message was sent in Unix time */
    public int $date;

    public $chat;

    /** @var int|null For messages forwarded from channels, identifier of the original message in the channel */
    public ?int $forward_from_message_id = null;

    /** @var string|null For messages forwarded from channels, signature of the post author if present */
    public ?string $forward_signature = null;

    /** @var string|null Sender's name for messages forwarded from users who disallow adding a link to their account in forwarded messages */
    public ?string $forward_sender_name = null;

    /** @var int|null For forwarded messages, date the original message was sent in Unix time */
    public ?int $forward_date = null;

    /** @var Message|null For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply. */
    public ?Message $reply_to_message = null;


    /** @var int|null Date the message was last edited in Unix time */
    public ?int $edit_date = null;

    /** @var string|null The unique identifier of a media message group this message belongs to */
    public ?string $media_group_id = null;

    /** @var string|null Signature of the post author for messages in channels, or the custom title of an anonymous group administrator */
    public ?string $author_signature = null;

    /** @var string|null For text messages, the actual UTF-8 text of the message, 0-4096 characters */
    public ?string $text = null;

    /** @var string|null Caption for the animation, audio, document, photo, video or voice, 0-1024 characters */
    public ?string $caption = null;

    /** @var string|null A chat title was changed to this value */
    public ?string $new_chat_title = null;

    /** @var bool|null Service message: the chat photo was deleted */
    public ?bool $delete_chat_photo = null;

    /** @var bool|null Service message: the group has been created */
    public ?bool $group_chat_created = null;

    /** @var bool|null Service message: the supergroup has been created. This field can't be received in a message coming through updates, because bot can't be a member of a supergroup when it is created. It can only be found in reply_to_message if someone replies to a very first message in a directly created supergroup. */
    public ?bool $supergroup_chat_created = null;

    /** @var bool|null Service message: the channel has been created. This field can't be received in a message coming through updates, because bot can't be a member of a channel when it is created. It can only be found in reply_to_message if someone replies to a very first message in a channel. */
    public ?bool $channel_chat_created = null;

    /** @var int|null The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier. */
    public ?int $migrate_to_chat_id = null;

    /** @var int|null The supergroup has been migrated from a group with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier. */
    public ?int $migrate_from_chat_id = null;


}
