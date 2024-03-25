<?php

namespace App\Utils;

use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class CustomerNotification
{
    private $messaging;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(__DIR__ . '/customer_firebase_credentials.json');

        $this->messaging = $factory->createMessaging();
    }

    public function sendNotification($topic, $title, $body, $jsonData = null)
    {
        $notification = Notification::create($title, $body);

        $message = CloudMessage::withTarget('topic', $topic)
            ->withNotification($notification);

        if ($jsonData !== null) {
            $message = $message->withData(['data' => $jsonData]);
        }

        Log::info(json_encode($jsonData));
        $response = $this->messaging->send($message);

        $logMessage = 'Topic sent to user ' . $topic . ' - response: ' . json_encode($response);

        Log::info($logMessage);
    }

//    public function sendNotification($topic, $title, $body, $jsonData = null)
//    {
//
//        $notification = Notification::create($title, $body);
//
//        $message = CloudMessage::new()
//            ->withNotification($notification)
//            ->withData(['data' => $jsonData])
//            ->withTarget('topic', $topic);
//
//        try {
//
//            $response = $this->messaging->send($message);
//
//            $logMessage = 'Topic sent to user ' . $topic . ' - response: ' . json_encode($response);
//            Log::info($logMessage);
//        } catch (\Exception $e) {
//
//            Log::error('Error sending notification: ' . $e->getMessage());
//        }
//
//    }
}
