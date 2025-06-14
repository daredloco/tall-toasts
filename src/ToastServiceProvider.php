<?php

declare(strict_types=1);

namespace Usernotnull\Toast;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route as RouteFacade;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Usernotnull\Toast\Controllers\JavaScriptAssets;
use Usernotnull\Toast\Livewire\ToastComponent;

class ToastServiceProvider extends PackageServiceProvider
{
    /* More info: https://github.com/spatie/laravel-package-tools */
    public function configurePackage(Package $package): void
    {
        $package->name('tall-toasts')
            ->hasConfigFile()
            ->hasViews();
    }

    public function registeringPackage(): void
    {
        $this->app->singleton(Toast::class);
        $this->app->alias(Toast::class, 'toast');

        $this->app->singleton(ToastManager::class);
        $this->app->alias(ToastManager::class, 'toast.manager');
    }

    public function boot()
    {
        parent::boot();

        RouteFacade::get('/toast/tall-toasts.js', [JavaScriptAssets::class, 'source']);
        RouteFacade::get('/toast/tall-toasts.js.map', [JavaScriptAssets::class, 'maps']);

        Blade::directive('toastScripts', [ToastBladeDirectives::class, 'toastScripts']);

        Livewire::component('toasts', ToastComponent::class);

        $this->publishes([
            __DIR__.'/../resources/js/tall-toasts.js' => resource_path('js/vendor/tall-toasts.js'),
        ], 'tall-toasts-js');
    }
}
