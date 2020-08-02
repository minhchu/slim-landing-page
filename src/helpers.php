<?php

if (!function_exists('escape')) {
    function escape($var, $option = FILTER_SANITIZE_STRING)
    {
        return filter_var($var, $option);
    }
}

if (!function_exists('env')) {
    function env($value, $default = null)
    {
        $dotenv = new Dotenv\Dotenv(__DIR__.'/../');
        $dotenv->load();

        return getenv($value) ? getenv($value) : $default;
    }
}
