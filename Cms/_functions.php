<?php

/**
 * CMS function sets
 *
 * @category  CMS
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */

if (! function_exists('redirect_options')) {
    /**
     * Returns the IP address from a request
     *
     * @return array
     */
    function redirect_options(): array
    {
        $codes = [];
        $status = config('http.300_codes');
        array_map(
            function ($code, $description) use (&$codes) {
                $codes[$code] = $code.' - '.$description;
            },
            array_keys($status),
            $status
        );
        return $codes;
    }
}