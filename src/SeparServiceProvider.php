<?php

/*
 * This file is part of Laravel Separ.
 *
 * (c) Aboozar Ghaffari <aboozar.ghf@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tartan\Separ;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the Separ service provider class.
 *
 * @author Aboozar Ghaffari <aboozar.ghf@gmail.com>
 */
class SeparServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig(): void
    {
        $source = realpath($raw = __DIR__ . '/../config/separ.php') ?: $raw;

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('separ.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('separ');
        }

        $this->mergeConfigFrom($source, 'separ');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('separ', function (Container $app) {
            $config = $app['config']['separ.users'];

            return new Separ($config);
        });

        $this->app->alias('separ', Separ::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'separ',
        ];
    }
}
