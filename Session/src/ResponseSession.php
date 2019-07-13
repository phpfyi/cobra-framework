<?php

namespace Cobra\Session;

use Cobra\Interfaces\Session\SessionInterface;
use Cobra\Session\Traits\SessionActions;

/**
 * Response Session
 *
 * Mutable HTTP response session data class
 *
 * Allows the modification of a session data
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
class ResponseSession extends Session
{
    use SessionActions;
    
    /**
     * Sets a value on the session array
     *
     * @param  string $name
     * @param  mixed  $value
     * @return SessionInterface
     */
    public function set(string $name, $value): SessionInterface
    {
        $this->data[$name] = $value;
        return $this;
    }

    /**
     * Sets the entire session array values
     *
     * @param  array $data
     * @return SessionInterface
     */
    public function setAll(array $data): SessionInterface
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Appends an array into the current session array
     *
     * @param  array $data
     * @return SessionInterface
     */
    public function setArray(array $data): SessionInterface
    {
        array_map(
            function ($key, $value) {
                $this->set($key, $value);
            },
            array_keys($data),
            $data
        );
        return $this;
    }

    /**
     * Removes a session array value
     *
     * @param  string $name
     * @return SessionInterface
     */
    public function remove(string $name): SessionInterface
    {
        array_key_unset($name, $this->data);
        return $this;
    }

    /**
     * Removes an array of session values
     *
     * @param  array $keys
     * @return SessionInterface
     */
    public function removeArray(array $keys): SessionInterface
    {
        array_map(
            function ($key) {
                $this->remove($key);
            },
            $keys
        );
        return $this;
    }
}
