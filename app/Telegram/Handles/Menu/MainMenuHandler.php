<?php

namespace App\Telegram\Handles\Menu;

use App\Enums\ProductStatus;
use App\Models\Bot;
use App\Models\Category;
use App\Models\Product;
use App\Models\TelegramUser;
use App\Telegram\Api\Client;
use App\Telegram\Message;
use App\Telegram\Traits\Pagination;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class MainMenuHandler extends Client
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

    public function products()
    {

    }

    public function categories($page = 1, $update = false)
    {
        if ($update) {
            $this->editMessageReplyMarkup($this->message->chat->id, $this->message->message_id, [
                'reply_markup' => json_encode([
                    'inline_keyboard' => $this->categoryPagination($page)
                ])
            ]);
        } else {
            $this->sendMessage($this->message->chat->id, config('telegram.' . $this->user->lang)['categories'], [
                'reply_markup' => json_encode([
                    'inline_keyboard' => $this->categoryPagination($page)
                ])
            ]);
        }
    }

    public function getProductsByCategory($category_id, $products_page, $update = false) //TODO: add page
    {
        $product = Product::query()
            ->where('category_id', $category_id)
            ->where('user_id', $this->bot->user_id)
            ->where('status', ProductStatus::ACTIVE)->skip($products_page - 1)
            ->with(['image'])
            ->first();

            $this->sendPhoto($this->message->chat->id, config('telegram.image_url') . $this->bot->user_id . '/' . $product->id . '/' . $product->image->path, [
                'caption' => <<<EOF
$product->name

Price: $product->price

$product->description
EOF,
                'reply_markup' => json_encode([
                    'inline_keyboard' => $this->productPagination($products_page, $category_id)
                ])
            ]);
        $this->deleteMessage($this->message->chat->id, $this->message->message_id);

    }

    public function settings()
    {

    }

    public function orders()
    {

    }

}
