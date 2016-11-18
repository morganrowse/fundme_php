<?php

use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $application_count = 0;
        while ($application_count < 15) {
            factory(App\Application::class, 1)
                ->create();
            $application_count++;
        }
    }
}
