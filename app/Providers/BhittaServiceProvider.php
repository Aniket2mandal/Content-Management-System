<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class BhittaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Log::info("Booting BhittaServiceProvider...");

         // Ensure bhitta.json is initialized
         initializeBhittaConfig();
        //  Log::info('BhittaConfig initialized');
        //  Log::info('BhittaConfig write sucessfully');
    }
}
