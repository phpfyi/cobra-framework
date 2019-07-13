<?php

namespace Cobra\Session;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Session\SessionInterface;
use Cobra\Object\AbstractObject;

/**
 * Session
 *
 * Abstract session class for request and response sessions
 *
 * @category  Session
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
abstract class Session extends AbstractObject implements SessionInterface
{
    /**
     * HTTP request instance
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * Array of session data
     *
     * @var array
     */
    protected $data = [];

    /**
     * Sets the required properties
     *
     * @param RequestInterface $request
     * @param array $data
     */
    public function __construct(RequestInterface $request, array $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    /**
     * Returns the session data array.
     *
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * Returns a session value.
     *
     * @param  string $name
     * @return void
     */
    public function get(string $name)
    {
        return array_key($name, $this->data);
    }
}
