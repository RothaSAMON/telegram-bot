<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\TelegramController;
use App\Notifications\ExampleNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('form');
});

Route::get('/', [FormController::class, 'show']);

// Route::post('/form-submit', function () {    
//     Notification::route('telegram', 'id')->notify(new ExampleNotification);
// });
Route::post('/form-submit', function () {
    try {
        Notification::route('telegram', request('telegram_user'))
            ->notify(new ExampleNotification());
        return redirect('/')->with('success', 'Message sent!');
    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Failed to send message.');
    }
});

Route::post('/telegram/webhook', [TelegramController::class, 'webhook']);
