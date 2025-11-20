<?php

namespace Alphavel\Events;

use Alphavel\Framework\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Merge package config with application config
        $this->mergeConfigFrom(
            __DIR__ . '/config/events.php',
            'events'
        );

        $this->app->singleton('events', function ($app) {
            $dispatcher = new EventDispatcher();
            
            // Register listeners from config
            $listeners = $app->config('events.listeners', []);
            foreach ($listeners as $event => $eventListeners) {
                foreach ($eventListeners as $listener) {
                    $dispatcher->listen($event, $listener);
                }
            }
            
            return $dispatcher;
        });

        // Auto-register facade
        $this->facades([
            'Event' => 'events',
        ]);
    }

    public function boot(): void
    {
        // Publish configuration file
        $basePath = dirname(__DIR__, 3);
        
        $this->publishes([
            __DIR__ . '/config/events.php' => $basePath . '/config/events.php',
        ], 'config');
    }

    protected function mergeConfigFrom(string $path, string $key): void
    {
        if (!file_exists($path)) {
            return;
        }

        $packageConfig = require $path;
        $appConfig = $this->app->config($key, []);
        $merged = array_replace_recursive($packageConfig, $appConfig);

        $tempFile = sys_get_temp_dir() . '/alphavel_events_config_' . uniqid() . '.php';
        file_put_contents($tempFile, '<?php return ' . var_export([$key => $merged], true) . ';');
        
        $this->app->loadConfig($tempFile);
        unlink($tempFile);
    }

    protected function publishes(array $paths, string $group = null): void
    {
        foreach ($paths as $source => $destination) {
            $configDir = dirname($destination);
            if (!is_dir($configDir) && strpos($configDir, '/config') !== false) {
                @mkdir($configDir, 0755, true);
            }
        }
    }
}
