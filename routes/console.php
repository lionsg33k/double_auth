<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('auth', function () {
    User::all()->each(function ($user) {
        if ($user && $user->validation_code) {
            $user->validation_code = rand(100000, 999999);
            $user->save();
        }
    });
});



Schedule::call(function () {
    User::all()->each(function ($user) {
        if ($user && $user->validation_code) {
            $user->validation_code = rand(100000, 999999);
            $user->save();
        }
    });
})->weekly()->mondays()->at("08:00");
