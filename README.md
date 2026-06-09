# Filament Announcement

<p align="center">
    <a href="https://packagist.org/packages/hasanyagout/filament-announcements">
            <img src="https://img.shields.io/packagist/v/hasanyagout/filament-announcements?style=flat-square" alt="Latest Version" />
    </a>

<a href="https://packagist.org/packages/hasanyagout/filament-announcements"> 
        <img src="https://img.shields.io/packagist/dt/hasanyagout/filament-announcements?style=flat-square" alt="Total Downloads">
</a>
<a href="https://packagist.org/packages/hasanyagout/filament-announcements">
    <img src="https://img.shields.io/packagist/php-v/hasanyagout/filament-announcements?style=flat-square" alt="PHP Version"> 
</a> 
<a href="https://github.com/HasanYagout/filament-announcement/blob/main/LICENSE"> 
    <img src="https://img.shields.io/github/license/HasanYagout/filament-announcement?style=flat-square" alt="License"> 
</a>
    
</p>


A powerful Filament plugin for broadcasting announcements to all users or specific recipients with support for scheduling, dismissible alerts, live updates, and custom recipient models.

---

## Features

- ✅ Global announcements
- ✅ Targeted recipients
- ✅ Dismissible announcements
- ✅ Live polling updates
- ✅ Scheduled announcements
- ✅ Multiple announcement types
- ✅ Translation ready
- ✅ Filament native UI
- ✅ Custom recipient models
- ✅ User-specific visibility
- ✅ Laravel policy support

---

## Installation

Install the package via Composer:

```bash
composer require hasanyagout/filament-announcements
```

> [!IMPORTANT]
> If you are using Filament Panels and have not set up a custom theme yet,
> follow the official Filament documentation first:
>
> https://filamentphp.com/docs/4.x/styling/overview#creating-a-custom-theme

After setting up a custom theme, add the plugin views to your theme CSS file:

```css
@source '../../../../vendor/hasanyagout/announcements/resources/**/*.blade.php';
```

Publish and run migrations:

```bash
php artisan vendor:publish --tag="announcement-migrations"
php artisan migrate
```

Publish the config file:

```bash
php artisan vendor:publish --tag="announcement-config"
```

Optionally publish translations:

```bash
php artisan vendor:publish --tag="announcement-translations"
```

Optionally publish views:

```bash
php artisan vendor:publish --tag="announcement-views"
```

---

## Setup

1. Register the plugin inside your Filament panel provider:

```php
use HasanYagout\Announcement\AnnouncementPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            AnnouncementPlugin::make(),
        ]);
}
```

2. Add the trait to your User model:

```php
use HasanYagout\Announcement\Traits\HasAnnouncements;

class User extends Authenticatable
{
    use HasAnnouncements;
}
```

---

## Configuration

Example configuration:

```php
use App\Models\User;

return [

    'recipient_models' => [

        User::class => [
            'label' => 'Users',
            'title_attribute' => 'name',
        ],

    ],

];
```

---

## Polling Interval

Customize the polling interval:

```php
AnnouncementPlugin::make()
    ->pollingInterval('10s')
```

---

## Custom Recipient Models

You can register custom recipient models dynamically:

```php
AnnouncementPlugin::make()
    ->withCustomRecipients([
        App\Models\User::class => [
            'label' => 'Users',
            'title_attribute' => 'name',
        ],
    ])
```

---

## Announcement Types

Supported announcement types:

- `info`
- `warning`
- `danger`
- `success`

---

## Translation Support

The plugin is fully translation-ready.

Example:

```php
__('announcement::filament.form.title.label')
```

---

## Scheduling

Announcements support scheduling using:

- `starts_at`
- `ends_at`

Only active announcements are displayed automatically.

---

## Dismissible Announcements

Users can dismiss announcements individually.

Dismiss states are stored per recipient.

---

## Recipient Targeting

Announcements can be:

- Global (`is_global`)
- Assigned to specific users/models

Supported via polymorphic recipient relationships.

---

## Permissions & Policies

The plugin supports Laravel Policies.

Example policy registration:

```php
protected $policies = [
    \HasanYagout\Announcement\Models\Announcement::class =>
        \HasanYagout\Announcement\Policies\AnnouncementPolicy::class,
];
```

---

## Screenshots

Add screenshots here later.

Example:

```md
![Announcements](docs/images/announcements.png)
```

---

## Testing

```bash
composer test
```

---

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes.

---

## Contributing

Contributions, issues, and feature requests are welcome.

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

---

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

---

## Credits

- [Hasan Yagout](https://github.com/HasanYagout)

---

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
