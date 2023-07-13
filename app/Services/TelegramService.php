<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    private string $token;
    private int $chatId;
    private string $url;

    public function __construct()
    {
        $this->url = "https://api.telegram.org/bot";
        $this->chatId = -1001849119254;
        $this->token = "6324935363:AAGvbpOyubvGzSJYlCgBfnnIKKYxo8w2jk8";
    }


    /**
     * Отправляет сообщение в Телеграм
     * @param string $message принимает текст сообщения
     * @return void
     */
    public function sendingToTelegram(string $message): void
    {
        $getQuery = [
            "chat_id" 	=> $this->chatId,
            "text"  	=> $message,
            "parse_mode" => "html"
        ];

        Http::post($this->url . $this->token ."/sendMessage?" . http_build_query($getQuery));
    }

    /**
     * Создает текст сообщения в Телеграм на основе данных из формы
     * @param array $data данные из формы
     * @return string возвращает текст сообщения
     */
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
