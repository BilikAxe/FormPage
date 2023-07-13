<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    private string $token = "6324935363:AAGvbpOyubvGzSJYlCgBfnnIKKYxo8w2jk8";
    private int $chatId = -1001849119254;
    private string $url = "https://api.telegram.org/bot";

    public function sendingToTelegram(string $message): ?object
    {
        $getQuery = [
            "chat_id" 	=> $this->chatId,
            "text"  	=> $message,
            "parse_mode" => "html"
        ];

        $response = Http::post($this->url . $this->token ."/sendMessage?" . http_build_query($getQuery));

        return $response->object();
    }

    public function createMessage(array $data): string
    {
        return "
            Добавлен новый лид\n
            Имя: {$data['first_name']}\n
            Фамилия: {$data['last_name']}\n
            Отчество: {$data['surname']}\n
            Дата рождения: {$data['birthday']}\n
            Телефон: {$data['phone']}\n
            Емейл: {$data['email']}\n
            Коментарии: {$data['comment']}
            ";
    }
}
