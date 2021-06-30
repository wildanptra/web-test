<?php
/**
 * re-Write by Muhamad Yusup Hamdani
 * based on documentation : https://firebase-php.readthedocs.io/en/5.14.1/cloud-messaging.html
 * contribution:
 * - your name here
 * */

require __DIR__ . '/../../library/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

function factory()
{
    return (new Factory)->withServiceAccount(__DIR__ . '/../../prioritasgroup-firebase-adminsdk-dci1s-f4250e51c8.json');
}

function messaging()
{
    return factory()->createMessaging();
}

/* Send Message to topic */
function send_to_topic($topic, $notification = [], $data = [])
{
    $message = CloudMessage::fromArray([
        'topic' => $topic,
        'notification' => $notification, // optional
        'data' => $data, // optional
        // 'data' => [/* data array */], // optional
    ]);

    return messaging()->send($message);
}

/* Send Message to spesific device (one device) */
function send_to_device($token, $notification = [], $data = [])
{
    $message = CloudMessage::fromArray([
        'token'         => $token,
        'notification'  => $notification, // optional
        'data'          => $data, // optional
    ]);

    return messaging()->send($message);
}

/* Subsciribe tokens to topic */
function subscribe_to_topic($topic, $registrationTokenOrTokens) {
    return messaging()->subscribeToTopic($topic, $registrationTokenOrTokens);
}


// print_r(send_to_topic('com.kumpul.mitrapg', [], [
//     "title" => "Semangat Pagi!!",
//     "content" => "2021, BANGKIT, BERANI, BERPRESTASI",
//     "sound" => "default",
// ]));