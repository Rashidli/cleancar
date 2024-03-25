<?php
namespace App\Services;

use App\Models\SMS;
use DOMDocument;
class SendSms
{

    public function send_sms($message, $phone)
    {

        $sms = SMS::query()->orderByDesc('control_id')->first();

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        $root = $dom->createElement('request');
        $dom->appendChild($root);

        $result = $dom->createElement('head');
        $root->appendChild($result);

        $result->appendChild($dom->createElement('operation', 'submit'));
        $result->appendChild($dom->createElement('login', 'washing'));
        $result->appendChild($dom->createElement('password','cleancar@vibrant'));
        $result->appendChild($dom->createElement('controlid', "$sms->control_id"));
        $result->appendChild($dom->createElement('title', 'Clean car'));
        $result->appendChild($dom->createElement('scheduled', 'now'));
        $result->appendChild($dom->createElement('isbulk', 'false'));

        $result = $dom->createElement('body');
        $root->appendChild($result);
        $result->appendChild($dom->createElement('message', $message));
        $result->appendChild($dom->createElement('msisdn', $phone));

        $xml = $dom->saveXML();

        $curl = curl_init("https://sms.atatexnologiya.az/bulksms/api");
        curl_setopt_array($curl, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $xml,
            CURLOPT_RETURNTRANSFER => true
        ]);
        $result = curl_exec($curl);
        curl_close($curl);

        $ob = simplexml_load_string($result);
        $json = json_encode($ob);
        $response = json_decode($json, true);
        SMS::query()->insert(['control_id' => $sms->control_id + 1]);

        return $response;

    }
}
