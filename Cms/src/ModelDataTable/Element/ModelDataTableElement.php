<?php

namespace Cobra\Cms\ModelDataTable\Element;

use Cobra\Interfaces\Cms\ModelDataTable\Element\ModelDataTableElementInteface;
use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableInterface;
use Cobra\Object\AbstractObject;
use Cobra\View\Traits\UsesTemplate;
use Cobra\View\Traits\RendersTemplate;

/**
 * Model Data Table Element
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
class ModelDataTableElement extends AbstractObject implements ModelDataTableElementInteface
{
    use UsesTemplate, RendersTemplate;

    /**
     * Element template position
     *
     * @var string
     */
    protected $position = 'top';

    /**
     * Element string alias
     *
     * @var string
     */
    protected $alias;

    /**
     * Sets the element table instance
     *
     * @param  ModelDataTableInterface $table
     * @return ModelDataTableElementInteface
     */
    public function setTable(ModelDataTableInterface $table): ModelDataTableElementInteface
    {
        $this->table = $table;
        return $this;
    }

    /**
     * Returns the element table instance
     *
     * @return ModelDataTableInterface
     */
    public function getTable(): ModelDataTableInterface
    {
        return $this->table;
    }

    /**
     * Sets the element template position
     *
     * @param  string $position
     * @return ModelDataTableElementInteface
     */
    public function setPosition(string $position): ModelDataTableElementInteface
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Returns the element template position
     *
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * Sets the element string alias
     *
     * @param  string $alias
     * @return ModelDataTableElementInteface
     */
    public function setAlias(string $alias): ModelDataTableElementInteface
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * Returns the element string alias
     *
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }
}
