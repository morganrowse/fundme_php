<?php

use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $donation_count = 0;
        while ($donation_count < 45) {
            factory(App\Donation::class, 1)
                ->create();
            $donation_count++;
        }
    }
}
