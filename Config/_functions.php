<?php

use Cobra\Config\Config;

if (! function_exists('config')) {
    /**
     * Returns a config value
     *
     * @param  string $name
     * @return void
     */
    function config(string $name)
    {
        return Config::get($name);
    }
}
