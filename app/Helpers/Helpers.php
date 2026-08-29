<?php

use App\Helpers\IconHelper;

if (!function_exists('icon')) {
    function icon(string $name, string $class = ''): string
    {
        return IconHelper::get($name, $class);
    }
}