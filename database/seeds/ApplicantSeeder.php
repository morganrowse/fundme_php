<?php

use Illuminate\Database\Seeder;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Applicant::class, 15)->create()->each(function ($u) {
            $u->user()->save(factory(App\User::class)->make());
        });
    }
}
