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
            self::Info => __('announcements::types.info'),
            self::Warning => __('announcements::types.warning'),
            self::Danger => __('announcements::types.danger'),
            self::Success => __('announcements::types.success'),
        };
    }
}
