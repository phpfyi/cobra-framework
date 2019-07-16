<?php

namespace Cobra\Amp\Html;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Object\AbstractObject;

/**
 * AMP Request Validator
 *
 * @category  AMP
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class AmpRequestValidator extends AbstractObject
{
    /**
     * Origin HTTP Header
     *
     * @var string
     */
    protected $origin;

    /**
     * AMP-Same-Origin HTTP Header
     *
     * @var string
     */
    protected $sameOrigin;

    /**
     * __amp_source_origin GET var
     *
     * @var string
     */
    protected $sourceOrigin;
    
    /**
     * Sets the required properties
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $origins = (array) $request->getHeader('Origin');
        $sameOrigins = (array) $request->getHeader('AMP-Same-Origin');

        $this->origin = !empty($origins) ? $origins[0] : null;
        $this->sameOrigin = !empty($sameOrigins) ? $sameOrigins[0] : null;
        $this->sourceOrigin = $request->getUri()->getVar('__amp_source_origin');
    }

    /**
     * Returns the __amp_source_origin GET var.
     *
     * @return string|null
     */
    public function getSourceOrigin():? string
    {
        return $this->sourceOrigin;
    }

    /**
     * Validates the AMP Request.
     *
     * @return boolean
     */
    public function validate(): bool
    {
        if (!$this->hasHeaders()) {
            return false;
        }
        if ($this->useOriginHeader()) {
            if (!in_array($this->origin, env('AMP_ORIGINS'))) {
                return false;
            }
        }
        if ($this->useSameOriginHeader()) {
            if ($this->sameOrigin !== 'true') {
                return false;
            }
        }
        if (!in_array($this->sourceOrigin, env('AMP_SOURCE_ORIGINS'))) {
            return false;
        }
        return true;
    }

    /**
     * Checks there is an origin type header set.
     *
     * @return boolean
     */
    protected function hasHeaders(): bool
    {
        return $this->origin || $this->sameOrigin;
    }

    /**
     * Checks there is an origin header set.
     *
     * @return boolean
     */
    protected function useOriginHeader(): bool
    {
        return $this->origin && !$this->sameOrigin;
    }

    /**
     * Checks there is a same origin header set.
     *
     * @return boolean
     */
    protected function useSameOriginHeader(): bool
    {
        return $this->sameOrigin && !$this->origin;
    }
}
