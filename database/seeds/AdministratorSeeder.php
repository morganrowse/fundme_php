<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Administrator::class, 0)
            ->create()
            ->each(function ($u) {
                $u->user()->save(factory(App\User::class)->make());
            });
    }
}
