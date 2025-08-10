<?php

namespace Joaopaulolndev\FilamentCheckSslWidget;

use Joaopaulolndev\FilamentCheckSslWidget\Widgets\CheckSslWidget;
use Closure;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;

class FilamentCheckSslWidgetPlugin implements Plugin
{
    use EvaluatesClosures;

    public array $domains = [];

    public Closure | bool $shouldShowTitle = true;

    public Closure | null | int $sort = null;

    public int | string | array $columnSpan = '1/2';

    public Closure | int $quantityPerRow = 1;

    public string | Closure | null $title = null;

    public string | Closure | null $description = null;

    public function getId(): string
    {
        return 'filament-check-ssl-widget';
    }

    public function register(Panel $panel): void
    {
        $panel->widgets([
            CheckSslWidget::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function domains(array $domains = []): static
    {
        $this->domains = $domains;

        return $this;
    }

    public function getDomains(): ?array
    {
        return $this->evaluate($this->domains);
    }

    public function shouldShowTitle(Closure | bool $value = true): static
    {
        $this->shouldShowTitle = $value;

        return $this;
    }

    public function getShouldShowTitle(): bool
    {
        return $this->evaluate($this->shouldShowTitle);
    }

    public function setTitle(Closure | string $value = ''): static
    {
        $this->title = $value;

        return $this;
    }

    public function getTitle(): ?string
    {
        return ! empty($this->title) ? $this->evaluate($this->title) : null;
    }

    public function setDescription(Closure | string $value = ''): static
    {
        $this->description = $value;

        return $this;
    }

    public function getDescription(): ?string
    {
        return ! empty($this->description) ? $this->evaluate($this->description) : null;
    }

    public function setSort(Closure | int | null $value = null): static
    {
        $this->sort = $value;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->evaluate($this->sort);
    }

    public function setColumnSpan(int | string | array $value = '1/2'): static
    {
        $this->columnSpan = $value;

        return $this;
    }

    public function getColumnSpan(): int | string | array
    {
        return $this->evaluate($this->columnSpan);
    }

    public function setQuantityPerRow(Closure | int $value = 1): static
    {
        $this->quantityPerRow = $value;

        return $this;
    }

    public function getQuantityPerRow(): ?int
    {
        return $this->evaluate($this->quantityPerRow);
    }
}
