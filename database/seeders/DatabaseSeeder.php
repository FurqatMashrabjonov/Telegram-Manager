<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();

        $user = \App\Models\User::query()->create([
            'name' => 'User',
            'email' => 'user@mail.ru',
            'password' => bcrypt('user12345')
        ]);

        $user->bot()->create(['token' => '2107607429:AAG2leDrFpRkGAbh9uP29kCxetYSCu4cuEM']);

        $this->call(CategorySeeder::class);
        Category::factory(40)->create();
        Product::factory(20)->create();
    }
}
