<?php

namespace App\Providers;

use App\Services\ChatGptService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $apiKey =  env('OPENAI_API_KEY');
        $this->app->singleton(ChatGPTService::class, function ($app) use ($apiKey) {
            return new ChatGptService($apiKey);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
