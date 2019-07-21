<?php

namespace Cobra\Page\Form;

use Cobra\Interfaces\Form\FormInterface;
use Cobra\Interfaces\Form\FormFactoryInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Form\Field\SpamField;
use Cobra\Form\Field\SubmitField;
use Cobra\Form\Field\TokenField;
use Cobra\Form\Form;
use Cobra\Object\AbstractObject;
use Cobra\Page\Form\Field\PageBlockRadioGroupField;

/**
 * Page Block Form Factory
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
class PageBlockFormFactory extends AbstractObject implements FormFactoryInterface
{
    /**
     * Sets the form request instance
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Returns the form instance
     *
     * @return FormInterface
     */
    public function getForm(): FormInterface
    {
        $blocks = page_block_classes();

        $group = PageBlockRadioGroupField::resolve('class');
        $group->setData($blocks);
        $group->setValue(get_class(array_shift($blocks)));

        $this->form = Form::resolve('PageBlock');
        $this->form->setAction($this->request->getUri()->getPath());
        $this->form->setField($group);
        $this->form
            ->setField(TokenField::resolve(config('form.csrf_field_name'))
                ->setValue(csrf()))
            ->setField(SpamField::resolve(config('form.spam_field_name')))
            ->setField(SubmitField::resolve('submit', 'Create'));
            
        return $this->form;
    }
}
