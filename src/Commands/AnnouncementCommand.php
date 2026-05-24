<?php

namespace HasanYagout\Announcement\Commands;

use HasanYagout\Announcement\Models\Announcement;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class AnnouncementCommand extends Command
{
    protected $signature = 'announcements:send';

    protected $description = 'Send pending announcements';

    public function handle(): int
    {
        $pending = Announcement::whereNull('sent_at')->get();

        foreach ($pending as $announcement) {
            $announcement->send();
            $this->info("Sent: {$announcement->title} to {$announcement->target_type} ID {$announcement->target_id}");
        }

        return CommandAlias::SUCCESS;
    }
}
