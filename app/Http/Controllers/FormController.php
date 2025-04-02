<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function show()
    {
        $users = TelegramUser::all();
        Log::info('Telegram Users Count: ' . $users->count()); // Debug line
        return view('form', ['users' => $users]);
    }
}