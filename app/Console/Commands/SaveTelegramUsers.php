<?php

namespace App\Console\Commands;

use App\Models\TelegramUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SaveTelegramUsers extends Command
{
    protected $signature = 'telegram:save-users';
    protected $description = 'Save users from Telegram updates';

    public function handle()
    {
        $response = Http::get('https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/getUpdates');
        
        if ($response->successful()) {
            $updates = $response->json()['result'];
            
            foreach ($updates as $update) {
                if (isset($update['message']['chat'])) {
                    $chat = $update['message']['chat'];
                    
                    TelegramUser::updateOrCreate(
                        ['chat_id' => $chat['id']],
                        [
                            'first_name' => $chat['first_name'],
                            'last_name' => $chat['last_name'] ?? null,
                            'username' => $chat['username'] ?? null,
                        ]
                    );
                }
            }
            
            $this->info('Users saved successfully!');
        }
    }
}