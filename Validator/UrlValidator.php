<?php

namespace Cobra\Validator;

use Cobra\Validator\Validator;

/**
 * URL Validator
 *
 * Validates a URL confirms to URL specification.
 *
 * @category  Validator
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class UrlValidator extends Validator
{
    /**
     * Error message
     *
     * @var string
     */
    protected $message = 'Invalid URL';

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'url';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  mixed $value
     * @return bool
     */
    public function validate($value = null): bool
    {
        $url = filter_var($value, FILTER_SANITIZE_URL);
            
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }
        return true;
    }
}
