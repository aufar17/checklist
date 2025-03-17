<?php

namespace App\Providers;

use App\Services\HydrantService;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File; // ✅ Perbaiki import File

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(HydrantService::class, function ($app) {
            return new HydrantService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $migrationFiles = collect(File::allFiles(database_path('migrations')))
            ->filter(fn($file) => str_ends_with($file->getFilename(), '.php'))
            ->map(fn($file) => $file->getPathname())
            ->toArray();

        $this->app->afterResolving(Migrator::class, function ($migrator) use ($migrationFiles) {
            $migrator->paths($migrationFiles);
        });

        if (env('APP_ENV') === 'local' && request()->server('HTTP_X_FORWARDED_PROTO') === 'https') {
            URL::forceScheme('https');
        }
    }
}
