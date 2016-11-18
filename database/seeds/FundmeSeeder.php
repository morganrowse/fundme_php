<?php

use Illuminate\Database\Seeder;

class FundmeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\User::where('email', 'admin@fundme.co.za')->count() == 0) {
            $administrator = new \App\Administrator();
            $administrator->save();

            $password = '1234';

            $user = new \App\User();
            $user->first_name = 'Administrator';
            $user->last_name = 'Test';
            $user->email = 'admin@fundme.co.za';
            $user->password = Hash::make($password);
            $user->avatar = 'defaultavatars/00002-00000-md.png';
            $user->userable_id = $administrator->id;
            $user->userable_type = 'App\Administrator';
            $user->save();
        }

        if (\App\User::where('email', 'applicant@fundme.co.za')->count() == 0) {
            $applicant = new \App\Applicant();
            $applicant->student_number = '12345';
            $applicant->cellphone = '12345';
            $applicant->address_line_1 = '48 Test ave';
            $applicant->address_line_2 = 'Rosebank';
            $applicant->address_line_3 = 'Johannesburg';
            $applicant->address_line_4 = '2194';
            $applicant->save();

            $password = '1234';

            $user = new \App\User();
            $user->first_name = 'Applicant';
            $user->last_name = 'Test';
            $user->email = 'applicant@fundme.co.za';
            $user->password = Hash::make($password);
            $user->avatar = 'defaultavatars/00002-00006-md.png';
            $user->userable_id = $applicant->id;
            $user->userable_type = 'App\Applicant';
            $user->save();
        }
    }
}
