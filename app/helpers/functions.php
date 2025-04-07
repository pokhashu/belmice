<?php

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

function sendSMS($phone, $message) {
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, 'http://api.csms.by/json/send');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "username=193644306&password=n6j3KvEu&phone=" . $phone . "&text=" . $message);

    $result = @json_decode(curl_exec($curl), true);

    if ($result && isset($result['id'])) {
        return "Message has been sent. MessageID=" . $result['id'];
    } elseif ($result && isset($result['error'])) {
        return "Error occurred while sending message. ErrorID=" . $result['error'];
    } else {
        return "Service error";
    }
}

echo "<pre>";
echo sendSMS("79779724821", "Код подтверждения: 123123.\nВнимание! Не сообщайте никому Ваш код.");
echo "</pre>";
//$token = "ffbc9832248f573eaf8ea799d3c33b99fd8c1ae6";
//$dadata = new \Dadata\DadataClient($token, null);
//$result = $dadata->findById("party", "7704347330", 1);
//echo "<pre>";
//print_r($result);
//echo "</pre>";
//http://grp.nalog.gov.by/api/grp-public/data?unp=193644306&charset=UTF-8&type=json
