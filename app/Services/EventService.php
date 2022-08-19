<?php

namespace App\Services;

use App\Models\{User, Event};

class EventService
{
    public static function userSubscribedOnEvent(User $user, Event $event)
    {
        return $user->events()->where('id', $event->id)->exists();
    }

    public static function eventEndDateHasPassed(Event $event)
    {
        return $event->end_date < now();
    }

    public static function eventParticipantLimitHasReached(Event $event)
    {
        return $event->users->count() === $event->participants_limit;
    }
}