<?php

namespace App\Telegram\Traits;

use App\Enums\ProductStatus;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

trait Pagination
{

    public function categoryPagination($page): array
    {
        $categories = Category::query()->select(['name', 'id'])
            ->where('user_id', $this->bot->user_id)
            ->skip(($page - 1) * 5)->take(5)->get();

        $categories_count = Category::query()
            ->where('user_id', $this->bot->user_id)
            ->count();

        $keyboards = [];

        foreach ($categories as $category) {
            $keyboards[] = [['text' => $category->name, 'callback_data' => 'categories.' . $category->id]];
        }

        if ($categories_count <= 5)
            return $keyboards;

        $bottom_buttons = [];

        if ($page > 1)
            $bottom_buttons[] = [
                'text' => '⏪',
                'callback_data' => 'categories.page.' . ($page - 1)
            ];


        $bottom_buttons[] = [
            'text' => (string)$page . ' / ' . (string)ceil($categories_count / 5),
            'callback_data' => '...'
        ];

        if ($page < ceil($categories_count / 5))
            $bottom_buttons[] = [
                'text' => '⏩',
                'callback_data' => 'categories.page.' . ($page + 1)
            ];
        $keyboards[] = $bottom_buttons;

        return $keyboards;
    }

    public function productPagination($page, $category_id)
    {
//        $products_count = Product::query()
//            ->where('user_id', $this->bot->user_id)
//            ->where('category_id', $category_id)
//            ->where('status', ProductStatus::ACTIVE)
//            ->count();
//
//        $buttons = [];
//
//        if ($page > 1)
//            $buttons[] = [
//                'text' => '⏪',
//                'callback_data' => 'categories.' . $category_id . '.products_page.' . ($page - 1)
//            ];
//
//        $buttons[] = [
//            'text' => $page . ' / ' . $products_count,
//            'callback_data' => '...'
//        ];
//
//        if ($page < $products_count)
//            $buttons[] = [
//                'text' => '⏩',
//                'callback_data' => 'categories.' . $category_id . '.products_page.' . ($page + 1)
//            ];
//
//        $prev_button = [
//            'text' => '⏪ Kategoriyalar',
//            'callback_data' => 'somethingnew'
//        ];
//
//        return [[$buttons], [[$prev_button]]]; //TODO
        Log::debug('keldiiiiiiiiiiiiiii');
    }

}
