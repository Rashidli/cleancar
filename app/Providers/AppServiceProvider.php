<?php

namespace App\Providers;

use App\Models\Touch;
use App\Models\Word;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $words = Word::all()->keyBy('key');
        View::share(['words' => $words]);
    }
}
