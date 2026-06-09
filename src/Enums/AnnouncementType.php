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
            self::Info => __('announcement::types.info'),
            self::Warning => __('announcement::types.warning'),
            self::Danger => __('announcement::types.danger'),
            self::Success => __('announcement::types.success'),
        };
    }
}
