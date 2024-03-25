<?php

namespace App\Utils;

use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class EmployeeNotification
{
    private $messaging;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(__DIR__ . '/employee_firebase_credentials.json');

        $this->messaging = $factory->createMessaging();
    }

    public function sendNotification($topic, $title, $body)
    {

        $notification = Notification::create($title, $body);

        $message = CloudMessage::withTarget('topic', $topic)
            ->withNotification($notification);

        $response = $this->messaging->send($message);

        $logMessage = 'Topic sent to user ' . $topic . ' - response: ' . json_encode($response);

        Log::info($logMessage);

    }
}
