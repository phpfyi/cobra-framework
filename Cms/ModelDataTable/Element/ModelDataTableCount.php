<?php

namespace Cobra\Cms\ModelDataTable\Element;

/**
 * Model Data Table Count Element
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
class ModelDataTableCount extends ModelDataTableElement
{
    /**
     * Template file path
     *
     * @var string
     */
    protected $template = 'templates.Model.ModelDataTable.ModelDataTableCount';

    /**
     * Element template position
     *
     * @var string
     */
    protected $position = 'above-left';

    /**
     * Element string alias
     *
     * @var string
     */
    protected $alias = 'count';

    /**
     * Model record count
     *
     * @var integer
     */
    protected $count = 0;

    /**
     * Sets the model record count
     *
     * @param  integer $count
     * @return ModelDataTableCount
     */
    public function setCount(int $count): ModelDataTableCount
    {
        $this->count = $count;
        return $this;
    }

    /**
     * Returns the model record count
     *
     * @return integer
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return [
            'count' => $this->getCount()
        ];
    }
}
