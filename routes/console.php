<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})
    ->purpose('Display an inspiring quote');

Artisan::command('idea', function () {
    $this->call('ide-helper:meta');
    $this->call('ide-helper:eloquent');
    $this->call('ide-helper:generate');
    $this->call('ide-helper:models', [
        '-M' => true,
        '-R' => true,
        '-F' => '.phpstorm.model.php',
        '-q' => true,
    ]);
})
    ->purpose('Generate IDE helper files');
