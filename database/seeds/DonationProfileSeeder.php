<?php

use Illuminate\Database\Seeder;

class DonationProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\DonationProfile::class, 5)
            ->create();
    }
}
