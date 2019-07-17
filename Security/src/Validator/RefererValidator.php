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
     * Request referers
     *
     * @var string
     */
    protected $referer;

    /**
     * Disallowed referers
     *
     * @var array
     */
    protected $referers = [];

    /**
     * Sets the required properties
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->referer = $request->getReferer();
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
     * @param  mixed $value
     * @return bool
     */
    public function validate($value = null): bool
    {
        return !array_strpos(
            $this->referers,
            $this->referer
        );
    }
}
