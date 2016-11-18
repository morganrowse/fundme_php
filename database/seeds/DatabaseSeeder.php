<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FundmeSeeder::class);

        $this->call(ApplicantSeeder::class);

        $this->call(DocumentationSeeder::class);

        $this->call(DonorSeeder::class);

        $this->call(DonationProfileSeeder::class);

        $this->call(AdministratorSeeder::class);

        $this->call(ApplicationSeeder::class);

        $this->call(DonationSeeder::class);

    }
}
