# A filamentPHP widget to get details about ssl certificate

[![Latest Version on Packagist](https://img.shields.io/packagist/v/joaopaulolndev/filament-check-ssl-widget.svg?style=flat-square)](https://packagist.org/packages/joaopaulolndev/filament-check-ssl-widget)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/joaopaulolndev/filament-check-ssl-widget/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/joaopaulolndev/filament-check-ssl-widget/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/joaopaulolndev/filament-check-ssl-widget/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/joaopaulolndev/filament-check-ssl-widget/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/joaopaulolndev/filament-check-ssl-widget.svg?style=flat-square)](https://packagist.org/packages/joaopaulolndev/filament-check-ssl-widget)

The Filament Check Ssl plugin widget designed to show the detail informations about the ssl certificate given domains.

<div class="filament-hidden">

![Screenshot of Application Feature](https://raw.githubusercontent.com/joaopaulolndev/filament-check-ssl-widget/main/art/joaopaulolndev-filament-check-ssl-widget.jpg)

</div>

## Installation

You can install the package via composer:

```bash
composer require joaopaulolndev/filament-check-ssl-widget
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-check-ssl-widget-views"
```

Optionally, you can publish the translations using

```bash
php artisan vendor:publish --tag="filament-check-ssl-widget-translations"
```

## Usage
Add in AdminPanelProvider.php

```php
use Joaopaulolndev\FilamentCheckSslWidget\FilamentCheckSslWidgetPlugin;

->plugins([
    FilamentCheckSslWidgetPlugin::make()
        ->domains([
            'laravel.com',
            'filamentphp.com',
            'github.com'
        ])
])
```

Optionally, you can add more configs as example below:

```php
use Joaopaulolndev\FilamentCheckSslWidget\FilamentCheckSslWidgetPlugin;

FilamentCheckSslWidgetPlugin::make()
    ->domains([
        'laravel.com',
        'filamentphp.com',
        'github.com'
    ])
    ->shouldShowTitle(false) // Optional show title default is: true
    ->setTitle('Certificates') // Optional
    ->setDescription('SSL certificate detail')  // Optional
    ->setQuantityPerRow(1) //Optional quantity per row default is: 1
    ->setColumnSpan('full') //Optional column span default is: '1/2' 
    ->setSort(10)
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [João Paulo Leite Nascimento](https://github.com/joaopaulolndev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
