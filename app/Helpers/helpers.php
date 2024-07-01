<?php

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
        return config('app.url') . '/' . ltrim($path);
    }
}

if (! function_exists('embedImage')) {
    function embedImage($pathToFile, $message) {
        return config('app.env') == 'local' && $message
            ? $message->embed(public_path($pathToFile))
            : app_url($pathToFile);
    }
}