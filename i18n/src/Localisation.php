<?php

namespace Cobra\i18n;

use Cobra\Config\Traits\Configurable;
use Cobra\Interfaces\i18n\LocalisationInterface;

/**
 * Localisation
 *
 * High level localisation class that can be interacted with for specific 
 * locale values and logic
 *
 * @category  i18n
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class Localisation implements LocalisationInterface
{
    use Configurable;

    /**
     * Sets the default timezone
     *
     * @param  string $timezone
     * @return void
     */
    public static function setTimezone(string $timezone): void
    {
        date_default_timezone_set($timezone);
    }

    /**
     * Returns an array of all countries
     *
     * @return array
     */
    public static function getCountries(): array
    {
        return static::config('countries');
    }
}
