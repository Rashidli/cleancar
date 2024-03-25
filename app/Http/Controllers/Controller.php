<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function createTranslatedLinks($slugs, $route): void
    {
        $translatedLinks = [];
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $translatedLinks[$locale] =
                LaravelLocalization::localizeUrl(
                    route($route, ['slug' => data_get($slugs, $locale, data_get($slugs, 'az', config('app.fallback_locale')))]),
                    $locale
                );
        }
        View::share('translatedLinks', $translatedLinks);

    }

}
