<?php

namespace Cobra\Security\Validator;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Validator\Validator;

/**
 * Referer Validator
 *
 * @category  Security
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class RefererValidator extends Validator
{
    /**
     * Disallowed referers
     *
     * @var array
     */
    protected $referers = [];

    /**
     * Sets the required properties
     */
    public function __construct()
    {
        $this->referers = env('DISALLOW_REFERERS');
    }

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'request-referer';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  RequestInterface $request
     * @return bool
     */
    public function validate($request = null): bool
    {
        return !array_strpos(
            $this->referers,
            $request->getReferer()
        );
    }
}
