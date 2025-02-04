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
        factory(App\Model\Client::class, 25)->create();
        //factory(App\Model\Sold::class, 75)->create();
        factory(App\Model\Product::class, 50)->create();
        factory(App\Model\Review::class, 300)->create();
        factory(App\Model\Sale::class, 100)->create();
        factory(App\Model\ReceivedProduct::class, 100)->create();
    }
}
