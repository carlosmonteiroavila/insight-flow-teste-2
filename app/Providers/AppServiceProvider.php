<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('database.default') === 'sqlite') {
            $dbPath = config('database.connections.sqlite.database');
            if ($dbPath && $dbPath !== ':memory:') {
                $dir = dirname($dbPath);
                if (!is_dir($dir)) {
                    @mkdir($dir, 0755, true);
                }
                if (!file_exists($dbPath) || filesize($dbPath) === 0) {
                    @touch($dbPath);
                    try {
                        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                    } catch (\Throwable $e) {
                        \Illuminate\Support\Facades\Log::error('Auto-migration failed: ' . $e->getMessage());
                    }
                }
            }
        }
    }
}
