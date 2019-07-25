<?php

namespace Cobra\Interfaces\i18n;

/**
 * Localisation Interface
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
interface LocalisationInterface
{
    /**
     * Sets the default timezone
     *
     * @param  string $timezone
     * @return void
     */
    public static function setTimezone(string $timezone): void;

    /**
     * Returns an array of all countries
     *
     * @return array
     */
    public static function getCountries(): array;
}
