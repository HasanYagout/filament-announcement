<?php

namespace HasanYagout\Announcement\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HasanYagout\Announcement\Announcement
 */
class Announcement extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \HasanYagout\Announcement\Announcement::class;
    }
}
