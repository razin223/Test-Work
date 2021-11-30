<?php

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WebsiteSeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\SubscriptionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            WebsiteSeeder::class,
            PostSeeder::class,
            SubscriptionSeeder::class,
        ]);
    }
}
