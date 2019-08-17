<?php

namespace Cobra\Model\Traits;

use Cobra\Interfaces\Model\ModelInterface;

/**
 * Model Data List Access trait
 *
 * @category  Model
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait ModelDataListAccess
{
    /**
     * Current list position
     *
     * @var integer
     */
    protected $position = 0;
    
    /**
     * List model array data
     *
     * @var array
     */
    protected $data = [];

    /**
     * Resets the list pointer
     *
     * @return void
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * Returns the current list item
     *
     * @return ModelInterface
     */
    public function current(): ModelInterface
    {
        return $this->data[$this->position];
    }

    /**
     * Returns the current list pointer key
     *
     * @return integer
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * Moves the list pointer forward
     *
     * @return void
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * Validates a list key exists
     *
     * @return boolean
     */
    public function valid(): bool
    {
        return isset($this->data[$this->position]) && $this->data[$this->position] !== false;
    }

    /**
     * Returns the array items count
     *
     * @return integer
     */
    public function count(): int
    {
        return count($this->data);
    }
}
