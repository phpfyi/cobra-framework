<?php

namespace Cobra\Page\Form\Field;

use Cobra\Form\Field\RadioGroupField;

/**
 * Page Block Radio Group Field
 *
 * @category  Page
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class PageBlockRadioGroupField extends RadioGroupField
{
    /**
     * Template to render the form field in
     *
     * @var string
     */
    protected $template = 'templates.Page.PageBlockRadioGroupField';
}
