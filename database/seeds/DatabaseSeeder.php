<?php

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
        // $this->call(UserSeeder::class);
        factory(App\User::class, 5)->create();
        factory(App\Models\NewsCategory::class, 5)->create();
        factory(App\Models\News::class, 10)->create();

        $this->call([
            UsersTableSeeder::class,
        ]);
    }
}
