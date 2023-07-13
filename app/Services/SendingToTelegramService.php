<?php

namespace App\Services;

class SendingToTelegramService
{
    public function sendingToTelegram(string $status, array $data): void
    {
        $token = "6324935363:AAGvbpOyubvGzSJYlCgBfnnIKKYxo8w2jk8";

        if ($status === "success") {
            $status = "
            Добавлен новый лид\n
            Имя: {$data['firstName']}\n
            Фамилия: {$data['lastName']}\n
            Отчество: {$data['surname']}\n
            Дата рождения: {$data['birthday']}\n
            Телефон: {$data['phone']}\n
            Емейл: {$data['email']}\n
            Коментарии: {$data['comment']}
            ";
        }

        $getQuery = array(
            "chat_id" 	=> -1001849119254,
            "text"  	=> $status,
            "parse_mode" => "html"
        );
        $ch = curl_init("https://api.telegram.org/bot". $token ."/sendMessage?" . http_build_query($getQuery));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $resultQuery = curl_exec($ch);
        curl_close($ch);

        echo $resultQuery;
    }
}
