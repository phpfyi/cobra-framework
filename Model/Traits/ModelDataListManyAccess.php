<?php

namespace Cobra\Model\Traits;

use Cobra\Interfaces\Model\ModelInterface;

/**
 * Model Data List Many Access trait
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
trait ModelDataListManyAccess
{
    use ModelDataListAccess;

    /**
     * Returns the current list item
     *
     * @return ModelInterface
     */
    public function current(): ModelInterface
    {
        if (!$this->data) {
            $this->get();
        }
        return $this->data[$this->position];
    }

    /**
     * Validates a list key exists
     *
     * @return boolean
     */
    public function valid(): bool
    {
        if (!$this->data) {
            $this->get();
        }
        return isset($this->data[$this->position]) && $this->data[$this->position] !== false;
    }

    /**
     * Returns the array items count
     *
     * @return integer
     */
    public function count(): int
    {
        if (!$this->data) {
            $this->get();
        }
        return count($this->data);
    }
}
