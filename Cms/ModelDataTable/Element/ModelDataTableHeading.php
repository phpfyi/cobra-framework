<?php

namespace Cobra\Cms\ModelDataTable\Element;

/**
 * Model Data Table Heading Element
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
class ModelDataTableHeading extends ModelDataTableElement
{
    /**
     * Template file path
     *
     * @var string
     */
    protected $template = 'templates.Model.ModelDataTable.ModelDataTableHeading';

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
    protected $alias = 'heading';

    /**
     * Heading text
     *
     * @var string
     */
    protected $heading;

    /**
     * Sets the heading text
     *
     * @param  string $heading
     * @return ModelDataTableHeading
     */
    public function setHeading(string $heading): ModelDataTableHeading
    {
        $this->heading = $heading;
        return $this;
    }

    /**
     * Returns the heading text
     *
     * @return string|null
     */
    public function getHeading():? string
    {
        return $this->heading;
    }
}
