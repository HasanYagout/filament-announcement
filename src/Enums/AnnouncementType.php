<?php

namespace HasanYagout\Announcement\Enums;

enum AnnouncementType: string
{
    case Info = 'info';
    case Warning = 'warning';
    case Danger = 'danger';
    case Success = 'success';

    public function label(): string
    {
        
        return match ($this) {
            self::Info => __('types.info'),
            self::Warning => __('types.warning'),
            self::Danger => __('types.danger'),
            self::Success => __('types.success'),
        };
    }
}
