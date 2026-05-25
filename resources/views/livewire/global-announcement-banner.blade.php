@php use HasanYagout\Announcement\Enums\AnnouncementType; @endphp

<div
    class="fi-global-announcements space-y-3 overflow-y-auto"
    wire:poll.{{ $this->pollingInterval }}
    style="position: relative; z-index: 50; max-height: 100px"
>
    @foreach($this->announcements as $announcement)

        @php
            $borderClass = match ($announcement->type) {
                AnnouncementType::Danger => 'border-danger-600 dark:border-danger-500',
                AnnouncementType::Warning => 'border-warning-600 dark:border-warning-500',
                AnnouncementType::Info => 'border-info-600 dark:border-info-500',
                AnnouncementType::Success => 'border-success-600 dark:border-success-500',
                default =>''
            };

            $icon = match ($announcement->type) {
                AnnouncementType::Danger => 'heroicon-o-exclamation-circle',
                AnnouncementType::Warning => 'heroicon-o-exclamation-triangle',
                AnnouncementType::Info => 'heroicon-o-information-circle',
                AnnouncementType::Success => 'heroicon-o-check-circle',
                default =>''
            };

            $iconColorCss = match ($announcement->type) {
                AnnouncementType::Danger => 'light-dark(#dc2626, #f87171)',
                AnnouncementType::Warning => 'light-dark(#d97706, #fbbf24)',
                AnnouncementType::Info => 'light-dark(#0369a1, #38bdf8)',
                AnnouncementType::Success => 'light-dark(#15803d, #4ade80)',
                default =>''
            };
        @endphp

        <div
            wire:key="announcement-{{ $announcement->id }}"
            class="overflow-hidden rounded-xl bg-gray-50 shadow-sm ring-1 ring-gray-950/5 dark:bg-white/5 dark:ring-white/10"
        >
            <div
                class="border-s-4 {{ $borderClass }} rounded-lg flex items-start gap-3 p-4"
                style="display: flex; align-items: flex-start; gap: 0.75rem 1rem; padding-block: 0.75rem; padding-inline: 1rem;"
            >
                <div style="flex-shrink: 0; line-height: 0;">
                    <x-filament::icon
                        :icon="$icon"
                        style="width: 2rem; height: 2rem; color: {{ $iconColorCss }};"
                    />
                </div>

                <div style="min-width: 0; flex: 1 1 0%; display: flex; justify-content: space-between; gap: 1rem;">

                    <div class="space-y-1" style="min-width: 0; flex: 1;">
                        <h3
                            style="margin: 0; font-size: 1rem; font-weight: 700; line-height: 1.35; color: light-dark(#030712, #ffffff);"
                        >
                            {{ $announcement->title }}
                        </h3>

                        @if ($announcement->body)
                            <div class="prose prose-sm max-w-none text-gray-600 dark:text-gray-300">
                                <p>
                                    {!! $announcement->body !!}
                                </p>
                            </div>
                        @endif
                    </div>

                    @if ($announcement->is_dismissible)
                        <div style="flex-shrink: 0;">
                            <x-filament::icon-button
                                color="gray"
                                icon="heroicon-o-x-mark"
                                :label="__('announcements::widget.dismiss')"
                                wire:click="dismiss({{ $announcement->id }})"
                            />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

</div>
