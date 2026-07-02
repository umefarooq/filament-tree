<?php

declare(strict_types=1);

namespace Studio15\FilamentTree;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Livewire\Livewire;
use Studio15\FilamentTree\Components\Footer;
use Studio15\FilamentTree\Components\Header;
use Studio15\FilamentTree\Components\Move;
use Studio15\FilamentTree\Components\Row;

final class FilamentTreePlugin implements Plugin
{
    public function getId(): string
    {
        return FilamentTreeServiceProvider::$name;
    }

    public function register(Panel $panel): void
    {
        //
    }

    public function boot(Panel $panel): void
    {
        Livewire::component('filament-tree::move', Move::class);
        Livewire::component('filament-tree::row', Row::class);
        Livewire::component('filament-tree::header', Header::class);
        Livewire::component('filament-tree::footer', Footer::class);

        FilamentAsset::register([
            Css::make('filament-tree', __DIR__.'/../resources/dist/filament-tree.min.css')->loadedOnRequest(),
            Js::make('filament-tree', __DIR__.'/../resources/dist/filament-tree.min.js')->loadedOnRequest(),
            Js::make('sortable', 'https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js')->loadedOnRequest(),
        ], package: '15web/filament-tree');
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        return filament(app(static::class)->getId());
    }
}
