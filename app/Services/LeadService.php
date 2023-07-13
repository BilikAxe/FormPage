<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LeadService
{
    public function addLead(array $data): string
    {
        $queryURL = "https://b24-dlbjfa.bitrix24.ru/rest/1/5bc8y3ytyh25ek4z/crm.lead.add.json";

        $result = Http::post($queryURL, [
            "fields" => [
                "NAME" => $data['first_name'],
                "LAST_NAME" => $data['last_name'],
                "SECOND_NAME" => $data['surname'],
                "BIRTHDATE" => $data['birthday'],
                "PHONE" => $data['phone'],
                "EMAIL" => $data['email'],
                "COMMENTS" => $data['comment']
            ],
            "params" => ["REGISTER_SONET_EVENT" => "Y"]
        ]);

        $result = json_decode($result,1);

        if(array_key_exists('error', $result))
        {
            return "Ошибка при сохранении лида: ".mb_substr($result['error_description'], 0, -4);
        }

        return "success";
    }
}
