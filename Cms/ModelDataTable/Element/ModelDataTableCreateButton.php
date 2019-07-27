<?php

namespace Cobra\Cms\ModelDataTable\Element;

/**
 * Model Data Table Create Button Element
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
class ModelDataTableCreateButton extends ModelDataTableElement
{
    /**
     * Template file path
     *
     * @var string
     */
    protected $template = 'templates.Model.ModelDataTable.ModelDataTableCreateButton';

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
    protected $alias = 'create-button';

    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return [
            'base_path' => $this->getTable()->getProps()->get('basePath')
        ];
    }
}
