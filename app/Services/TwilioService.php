<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class TwilioService
{
    public function sendVerificationCode(string $number, string $otp): bool
    {
        return $this->sendMessage($otp , $number, 'Your Verification Code is : ');
    }

//    public function sendNotification( $recipient, $body, $title)
//    {
//        return $this->sendMessage($body,$recipient,$title."\n");
//    }


    private function sendMessage(string $message, string $recipient, string $title = ""): bool
    {
        try {
            $sid = env("TWILIO_SID");
            $token = env("TWILIO_TOKEN");
            $senderNumber = env("TWILIO_FROM");

            $client = new Client($sid, $token);

            $client->messages->create("$recipient", [
                'from' => $senderNumber,
                'body' => $title . $message
            ]);

            return true;
        } catch (\Throwable $th) {
            Log::error("$th");
            Log::info("-------unable to send SMS to phone $recipient -------------");

            return false;
        }
    }
}
