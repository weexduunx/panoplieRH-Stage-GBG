<?php

namespace App\Providers;

use LaravelEnso\Calendar\CalendarServiceProvider as ServiceProvider;

class CalendarServiceProvider extends ServiceProvider
{
    protected $register = [
        BirthdayCalendar::class,
    ];
}
