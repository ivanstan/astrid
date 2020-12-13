<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

class ContactUsConversation extends Conversation
{
    private $email;
    private $subject;
    private $message;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function run()
    {
        $this->say('Your email is: ' . $this->email);

        $this->askSubject();
    }

    public function askSubject()
    {
        return $this->ask(
            'Just tell me what to put in the subject',
            function (Answer $answer) {
                $this->subject = $answer->getText();
                $this->askBody();
            }
        );
    }

    public function askBody()
    {
        return $this->ask(
            'Can you just write a message so I can forward it?',
            function (Answer $answer) {
                $this->message = $answer->getText();
                $this->say('Great. I\'ve sent your mail. Someone will contact you soon.');
            }
        );
    }
}
