<?php

use App\Quotation;
use Illuminate\Support\Facades\Route;

if (! function_exists('setActive')) {
    function setActive($route, $class = 'active') {
        $routes  = (array) $route;
        $current = Route::currentRouteName();

        return in_array($current, $routes)
            ? $class: '';
    }
}

if (! function_exists('app_url')) {
    function app_url($path = '') {
        return config('app.url') . str_start(ltrim($path), '/');
    }
}

if (! function_exists('embedImage')) {
    function embedImage($pathToFile, $message) {
        return config('app.env') == 'local' && $message
            ? $message->embed(public_path($pathToFile))
            : app_url($pathToFile);
    }
}

if (! function_exists('newQuotationCount')) {
    function newQuotationCount() {
        return Quotation::select('root_id')
            ->groupBy('root_id')
            ->havingRaw('SUM(CASE WHEN approved_at IS NULL THEN 0 ELSE 1 END) = 0')
            ->get()
            ->count();
    }
}