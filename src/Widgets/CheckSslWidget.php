<?php

namespace Joaopaulolndev\FilamentCheckSslWidget\Widgets;

use AllowDynamicProperties;
use AshAllenDesign\FaviconFetcher\Facades\Favicon;
use Exception;
use Filament\Facades\Filament;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Spatie\SslCertificate\SslCertificate;

#[AllowDynamicProperties]
class CheckSslWidget extends Widget
{
    protected static bool $isLazy = false;

    protected static string $view = 'filament-check-ssl-widget::filament.widgets.check-ssl-widget';

    protected array $certificates = [];

    public function __construct()
    {
        $domains = [];

        $plugin = Filament::getCurrentPanel()?->getPlugin('filament-check-ssl-widget');

        if ($plugin->getDomains()) {
            $domains = $plugin->getDomains();
        }

        foreach ($domains as $domain) {
            $this->certificates[] = Cache::remember("filament-check-ssl-widget-$domain", 604800, fn() => $this->getCertificate($domain));
        }
    }

    private function getCertificate(string $domain): array
    {
        $invalidDomain = [
            'domain' => $domain,
            'is_valid' => false,
            'issuer' => null,
            'expiration_date' => null,
            'expiration_date_in_days' => null,
            'favicon' => null,
        ];

        if ($this->isValidDomain($domain)) {
            try {
                $certificate = SslCertificate::createForHostName($domain);
            } catch (Exception $ignored) {
                $invalidDomain['favicon'] = $this->getFaviconByDomain($domain);
                return $invalidDomain;
            }
            if ($certificate) {
                return [
                    'domain' => $domain,
                    'is_valid' => $certificate->isValid(),
                    'issuer' => $certificate->getIssuer(),
                    'expiration_date' => $certificate->expirationDate(),
                    'expiration_date_in_days' => $certificate->expirationDate(),
                    'favicon' => $this->getFaviconByDomain($domain),
                ];
            }
        }

        return $invalidDomain;
    }

    private function isValidDomain($domain): bool
    {
        return (bool)preg_match('/^(?:[a-z0-9](?:[a-z0-9-æøå]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/isu', $domain);
    }

    private function getFaviconByDomain(string $domain): ?string
    {
        if (!Str::contains($domain, ['http://', 'https://'])) {
            $domain = 'https://' . $domain;
        }

        try {
            return Favicon::fetch($domain)?->cache(now()->addDay())->getFaviconUrl() ?? null;
        } catch (Exception $ignored) {
            return null;
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
