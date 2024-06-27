<?php

namespace Joaopaulolndev\FilamentCheckSslWidget\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Joaopaulolndev\FilamentCheckSslWidget\FilamentCheckSslWidget
 */
class FilamentCheckSslWidget extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Joaopaulolndev\FilamentCheckSslWidget\FilamentCheckSslWidget::class;
    }
}
