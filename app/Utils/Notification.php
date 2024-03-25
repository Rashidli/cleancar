<?php

namespace App\Utils;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Illuminate\Support\Facades\Log;



class Notification
{
    private static $instance;
    private $factory;
    private $messaging;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Notification();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $this->factory = (new Factory)->withServiceAccount(__DIR__ . '/firebase.json');
        $this->messaging = $this->factory->createMessaging();
    }

    public function __clone()
    {
    }


    public function send($title, $body, $tokens)
    {
        try {
            $message = $this->createMessage($title, $body);
            $this->messaging->sendMulticast($message, $tokens);
        } catch (\Exception $err) {
            Log::info('User failed to login. ' . $err->getMessage());
        }
    }

    public function createMessage($title, $body)
    {
        $message = [
            'notification' => [
                'title' => $title,
                'body' => $body
            ], // optional
            'priority' => 'high'
        ];
        return CloudMessage::fromArray($message);
    }

}
