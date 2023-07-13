<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BitrixService
{
    private string $queryURL;

    public function __construct()
    {
        $this->queryURL = "https://b24-dlbjfa.bitrix24.ru/rest/1/5bc8y3ytyh25ek4z/";
    }

    /**
     * Добавляет новый лид и контакт в Битрикс24
     * @param array $data массив данных из формы
     * @return string|null возвращает либо ошибку либо ничего
     */
    public function addLead(array $data): ?string
    {
        $phone = (!empty($data['phone'])) ? [['VALUE' => $data['phone'], 'VALUE_TYPE' => 'WORK']] : [];
        $email = (!empty($data['email'])) ? [['VALUE' => $data['email'], 'VALUE_TYPE' => 'HOME']] : [];

        $response = Http::post($this->queryURL . "crm.lead.add.json", [
            "fields" => [
                "NAME" => $data['first_name'],
                "LAST_NAME" => $data['last_name'],
                "SECOND_NAME" => $data['surname'],
                "BIRTHDATE" => $data['birthday'],
                "PHONE" => $phone,
                "EMAIL" => $email,
                "COMMENTS" => $data['comment']
            ],
            "params" => ["REGISTER_SONET_EVENT" => "Y"]
        ]);

        if($response->serverError() || $response->clientError()) {
            return "Ошибка при сохранении лида: ".mb_substr($response['error_description'], 0, -4);
        }

        return null;
    }
}
