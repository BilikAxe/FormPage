<?php

namespace App\Services;

class LeadAddService
{
    public function addLead(array $data): string
    {
        $queryURL = "https://b24-dlbjfa.bitrix24.ru/rest/1/5bc8y3ytyh25ek4z/crm.lead.add.json";

        $sName = htmlspecialchars($data['firstName']);
        $sLastName = htmlspecialchars($data['lastName']);
        $sSurname = htmlspecialchars($data['surname']);
        $sBirthday = htmlspecialchars($data['birthday']);
        $sPhone = htmlspecialchars($data['phone']);
        $sEmail = htmlspecialchars($data['email']);
        $sComment = htmlspecialchars($data['comment']);

        $arPhone = (!empty($sPhone)) ? array(array('VALUE' => $sPhone, 'VALUE_TYPE' => 'WORK')) : array();
        $arEmail = (!empty($sEmail)) ? array(array('VALUE' => $sEmail, 'VALUE_TYPE' => 'HOME')) : array();

        $queryData = http_build_query(array(
            "fields" => array(
                "NAME" => $sName,
                "LAST_NAME" => $sLastName,
                "SECOND_NAME" => $sSurname,
                "BIRTHDATE" => $sBirthday,
                "PHONE" => $arPhone,
                "EMAIL" => $arEmail,
                "COMMENTS" => $sComment
            ),
            "params" => array("REGISTER_SONET_EVENT" => "Y")
        ));

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $queryURL,
            CURLOPT_POSTFIELDS => $queryData,
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result,1);

        if(array_key_exists('error', $result))
        {
            return "Ошибка при сохранении лида: ".mb_substr($result['error_description'], 0, -4);
        }

        return "success";
    }
}
