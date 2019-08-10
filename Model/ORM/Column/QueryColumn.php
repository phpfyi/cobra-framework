<?php

namespace Cobra\Model\ORM\Column;

use Cobra\Model\ORM\Query;

/**
 * Query Column
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

abstract class QueryColumn extends Query
{ 
    /**
     * Column name
     *
     * @var string
     */
    protected $column;

    /**
     * Sets the required properties.
     *
     * @param string $column
     */
    public function __construct(string $column)
    {
        $this->column = $column;
    }
}