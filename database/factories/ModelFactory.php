<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password = '1234';

    $files = \Illuminate\Support\Facades\Storage::files('defaultavatars');
    $file = $files[rand(0,count($files))];

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => \Illuminate\Support\Facades\Hash::make($password),
        'avatar' => $file,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Applicant::class, function (Faker\Generator $faker) {

    return [
        'student_number' => $faker->bankAccountNumber,
        'cellphone' => $faker->phoneNumber,
        'address_line_1' => $faker->streetAddress,
        'address_line_2' => $faker->city,
        'address_line_3' => $faker->city,
        'address_line_4' => $faker->postcode,
        'created_at' => $faker->dateTimeBetween('-3 years'),
    ];
});

$factory->define(App\Administrator::class, function () {
    return [];
});

$factory->define(App\Application::class, function (Faker\Generator $faker) {

    $funding_type = \App\FundingType::inRandomOrder()->first();

    if(\App\Application::where('funding_type_id',$funding_type->id)->count()>0){
        $average = \App\Application::where('funding_type_id',$funding_type->id)->avg('amount');
        $amount = $faker->numberBetween($average/0.9, $average/1.1);
    } else {
        $amount = $faker->numberBetween(10000, 50000);
    }

    return [
        'applicant_id' => \App\Applicant::inRandomOrder()->first()->id,
        'funding_type_id' => $funding_type->id,
        'institution_name' => $faker->randomElement(array('Witwatersrand', 'UJ', 'UCT','UP','Monash')),
        'degree_type' => $faker->randomElement(array('Bsc', 'Bcom', 'BA','BEd','PhD')),
        'financial_means' => $faker->randomElement(array('A', 'B', 'C', 'D', 'E')),
        'amount' => $amount,
        'created_at' => $faker->dateTimeBetween('-2 years'),
    ];
});

$factory->define(App\Donor::class, function (Faker\Generator $faker) {

    return [
        'administrator_id' => \App\Administrator::inRandomOrder()->first()->id,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'organisation' => $faker->company,
        'address_line_1' => $faker->streetAddress,
        'address_line_2' => $faker->city,
        'address_line_3' => $faker->city,
        'address_line_4' => $faker->postcode,
        'email' => $faker->safeEmail,
        'created_at' => $faker->dateTimeBetween('-2 years'),
    ];
});

$factory->define(App\DonationProfile::class, function (Faker\Generator $faker) {

    return [
        'donor_id' => \App\Donor::inRandomOrder()->first()->id,
        'funding_type_id' => \App\FundingType::inRandomOrder()->first()->id,
        'maximum_amount' => $faker->numberBetween(5, 20000),
        'financial_means' => $faker->randomElement(array('A', 'B', 'C', 'D', 'E')),
        'created_at' => $faker->dateTimeBetween('-2 years'),
    ];
});

$factory->define(App\Donation::class, function (Faker\Generator $faker) {
    //\App\Application::join('donations', 'applications.id', '=', 'donations.application_id')->groupBy('applications.id')->select(DB::raw('applications.id as application_id, applications.amount as amount, SUM(donations.amount) as donated'))->having('amount','>','donated')->inRandomOrder()->get();



    $application = \App\Application::inRandomOrder()->first();
    $remaining = $application->amount - $application->getFundedAmount();

    return [
        'application_id' => $application->id,
        'donation_profile_id' => \App\DonationProfile::inRandomOrder()->first()->id,
        'amount' => $faker->numberBetween(0, $remaining),
        'agreement' => null,
        'created_at' => $faker->dateTimeBetween('-'.$application->created_at->diffInDays(Carbon::now()).' days'),
    ];
});

$factory->define(App\Documentation::class, function (Faker\Generator $faker) {
    $applicant = \App\Applicant::inRandomOrder()->first();

    $files = \Illuminate\Support\Facades\Storage::files('defaultavatars');
    $file = $files[rand(0,count($files))];

    return [
        'applicant_id' => $applicant->id,
        'attachment' => $file,
        'created_at' => $faker->dateTimeBetween('-2 years'),
    ];
});
