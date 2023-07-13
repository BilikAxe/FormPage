<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    public function sendingToTelegram(string $status, array $data): ?object
    {
        $token = "6324935363:AAGvbpOyubvGzSJYlCgBfnnIKKYxo8w2jk8";

        if ($status === "success") {
            $status = "
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

        $getQuery = [
            "chat_id" 	=> -1001849119254,
            "text"  	=> $status,
            "parse_mode" => "html"
        ];

        $response = Http::post("https://api.telegram.org/bot". $token ."/sendMessage?" . http_build_query($getQuery));

        return $response->object();
    }
}
