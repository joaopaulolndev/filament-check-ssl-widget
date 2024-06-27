<?php

namespace Joaopaulolndev\FilamentCheckSslWidget\Widgets;

use AllowDynamicProperties;
use AshAllenDesign\FaviconFetcher\Facades\Favicon;
use Exception;
use Filament\Facades\Filament;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Spatie\SslCertificate\Exceptions\CouldNotDownloadCertificate\UnknownError;
use Spatie\SslCertificate\SslCertificate;

#[AllowDynamicProperties]
class CheckSslWidget extends Widget
{
    protected static bool $isLazy = false;

    protected static string $view = 'filament-check-ssl-widget::filament.widgets.check-ssl-widget';

    protected array $certificates = [];

    public function __construct()
    {
        $domains = [

        ];

        $plugin = Filament::getCurrentPanel()?->getPlugin('filament-check-ssl-widget');

        if ($plugin->getDomains()) {
            $domains = $plugin->getDomains();
        }

        foreach ($domains as $domain) {
            try {
                $certificate = SslCertificate::createForHostName($domain);
            } catch (Exception $ignored) {
                $certificate = null;
            }

            if (Str::contains($domain, ['http://', 'https://'])) {
                $favicon = Favicon::fetch($domain)->getFaviconUrl();
            } else {
                $favicon = Favicon::fetch('https://' . $domain)->getFaviconUrl();
            }

            $this->certificates[] = [
                'domain' => $domain,
                'is_valid' => $certificate && $certificate->isValid(),
                'issuer' => $certificate ? $certificate->getIssuer() : null,
                'expiration_date' => $certificate ? $certificate->expirationDate()->diffForHumans() : null,
                'expiration_date_in_days' => $certificate ? $certificate->expirationDate()->diffInDays() : null,
                'favicon' => $favicon,
            ];
        }
    }

    public function shouldShowTitle(): bool
    {
        $plugin = Filament::getCurrentPanel()?->getPlugin('filament-check-ssl-widget');

        return $plugin->getShouldShowTitle();
    }

    public function title()
    {
        $plugin = Filament::getCurrentPanel()?->getPlugin('filament-check-ssl-widget');

        return $plugin->getTitle();
    }

    public function description()
    {
        $plugin = Filament::getCurrentPanel()?->getPlugin('filament-check-ssl-widget');

        return $plugin->getDescription();
    }

    public static function getSort(): int
    {
        $plugin = Filament::getCurrentPanel()?->getPlugin('filament-check-ssl-widget');

        return $plugin->getSort() ?? -1;
    }

    public function getColumnSpan(): int | string | array
    {
        $plugin = Filament::getCurrentPanel()?->getPlugin('filament-check-ssl-widget');

        return $plugin->getColumnSpan() ?? '1/2';
    }

    public function quantityPerRow()
    {
        $plugin = Filament::getCurrentPanel()?->getPlugin('filament-check-ssl-widget');

        return $plugin->getQuantityPerRow();
    }

    public function render(): View
    {
        return view(static::$view, [
            'certificates' => $this->certificates,
            'shouldShowTitle' => $this->shouldShowTitle(),
            'title' => $this->title(),
            'description' => $this->description(),
            'quantityPerRow' => $this->quantityPerRow() ?? '1',
        ]);
    }
}
