<?php

namespace App\Utils;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
class UserNotification
{

    public static function customerNotification($topic, $title, $body)
    {

        $factory = (new Factory)
            ->withServiceAccount(__DIR__ . '/customer_firebase_credentials.json');

        $messaging = $factory->createMessaging();

        $notification = Notification::create($title, $body);

        $message = CloudMessage::withTarget('topic', $topic)
            ->withNotification($notification);

        $response = $messaging->send($message);

        $logMessage = 'Topic sent to user ' . $topic . ' - response: ' . json_encode($response);
        Log::info($logMessage);
    }

}
