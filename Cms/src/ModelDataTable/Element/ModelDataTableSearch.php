<?php

namespace Cobra\Cms\ModelDataTable\Element;

/**
 * Model Data Table Search Element
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
class ModelDataTableSearch extends ModelDataTableElement
{
    /**
     * Template file path
     *
     * @var string
     */
    protected $template = 'templates.Model.ModelDataTable.ModelDataTableSearch';

    /**
     * Element template position
     *
     * @var string
     */
    protected $position = 'above-right';

    /**
     * Element string alias
     *
     * @var string
     */
    protected $alias = 'search';

    /**
     * Model search field
     *
     * @var string
     */
    protected $field = 'title';

    /**
     * Sets the model search field
     *
     * @param  string $field
     * @return ModelDataTableSearch
     */
    public function setField(string $field): ModelDataTableSearch
    {
        $this->field = $field;
        return $this;
    }

    /**
     * Returns the model search field
     *
     * @return string|null
     */
    public function getField():? string
    {
        return $this->field;
    }
}
