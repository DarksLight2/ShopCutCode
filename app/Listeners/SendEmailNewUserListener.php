<?php

namespace App\Listeners;

use App\Events\RegisterUserEvent;
use App\Notifications\NewUserNotification;

class SendEmailNewUserListener
{
    public function handle(RegisterUserEvent $event): void
    {
        $event->user->notify(new NewUserNotification());
    }
}
