<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function webhook(Request $request)
    {
        $data = $request->all();
        
        if (isset($data['message'])) {
            $chat = $data['message']['chat'];
            
            // Save or update user data
            TelegramUser::updateOrCreate(
                ['chat_id' => $chat['id']],
                [
                    'first_name' => $chat['first_name'],
                    'last_name' => $chat['last_name'] ?? null,
                    'username' => $chat['username'] ?? null,
                ]
            );
            
            Log::info("Telegram User saved: {$chat['first_name']} with ID: {$chat['id']}");
        }
        
        return response()->json(['status' => 'success']);
    }
}