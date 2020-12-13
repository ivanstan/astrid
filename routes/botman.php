<?php

use App\Conversations\ContactUsConversation;
use BotMan\BotMan\BotMan;

/** @var BotMan $botman */
$botman = resolve('botman');

$botman->hears(
    '{email}',
    function ($bot, $email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $bot->startConversation(new ContactUsConversation($email));
        } else {
            $bot->reply('This doesn\'t look like a valid email to me. Can you repeat?');
        }
    }
);
