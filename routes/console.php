<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('app:about-gtms', function () {
    $this->info('Gaming Tournament Management System is ready.');
})->purpose('Display GTMS information');
