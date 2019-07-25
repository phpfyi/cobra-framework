<?php

namespace Cobra\Form\Decorator;

use Cobra\Interfaces\Form\Field\FormFieldInterface;
use Cobra\Form\Field\SelectField;
use Cobra\Object\Decorator\ObjectDecorator;

/**
 * CSS Visibility Child Decorator
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
class CssVisibilityChildDecorator extends ObjectDecorator
{
    /**
     * Sets a CSS visibility parent class
     *
     * @return SelectField
     */
    public function cssVisibilityParent(): SelectField
    {
        $this->shadow->addHolderClass('visibility-handler');
        return $this->shadow;
    }

    /**
     * Sets as a CSS visibility child that responds to a parent value
     *
     * @param  string     $parent
     * @param  string|int $value
     * @return FormFieldInterface
     */
    public function cssVisibilityChild(string $parent, $value): FormFieldInterface
    {
        $this->shadow->addHolderClass('hidden');
        $this->shadow->setAttributes(
            [
                'data-visibility-parent' => $parent,
                'data-visibility-option' => $value
            ]
        );
        return $this->shadow;
    }
}
