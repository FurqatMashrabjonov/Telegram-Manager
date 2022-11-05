<?php

namespace App\Telegram\Traits;

use App\Models\Category;

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

}
