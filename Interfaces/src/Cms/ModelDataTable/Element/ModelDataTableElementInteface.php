<?php

namespace Cobra\Interfaces\Cms\ModelDataTable\Element;

use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableInterface;

/**
 * Model Data Table Element Interface
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
interface ModelDataTableElementInteface
{
    /**
     * Sets the element table instance
     *
     * @param  ModelDataTableInterface $table
     * @return ModelDataTableElementInteface
     */
    public function setTable(ModelDataTableInterface $table): ModelDataTableElementInteface;

    /**
     * Returns the element table instance
     *
     * @return ModelDataTableInterface
     */
    public function getTable(): ModelDataTableInterface;

    /**
     * Sets the element template position
     *
     * @param  string $position
     * @return ModelDataTableElementInteface
     */
    public function setPosition(string $position): ModelDataTableElementInteface;

    /**
     * Returns the element template position
     *
     * @return string
     */
    public function getPosition(): string;

    /**
     * Sets the element string alias
     *
     * @param  string $alias
     * @return ModelDataTableElementInteface
     */
    public function setAlias(string $alias): ModelDataTableElementInteface;

    /**
     * Returns the element string alias
     *
     * @return string
     */
    public function getAlias(): string;
}