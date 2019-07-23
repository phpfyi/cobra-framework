<?php

namespace Cobra\Cms\Traits;

use Cobra\Cms\CmsMessages;
use Cobra\Cms\CmsModelUrlParser;
use Cobra\Interfaces\Controller\ControllerInterface;
use Cobra\Interfaces\Form\FormInterface;

/**
 * Record Request Foundation trait
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
trait RecordRequestFoundation
{
    /**
     * Model URL parser instance
     *
     * @var CmsModelUrlParser
     */
    protected $parser;

    /**
     * Messages instance
     *
     * @var CmsMessages
     */
    protected $messages;

    /**
     * Sets the controller and form instances
     *
     * @param ControllerInterface $controller
     * @param FormInterface $form
     * @param CmsModelUrlParser   $parser
     */
    public function __construct(
        ControllerInterface $controller,
        FormInterface $form,
        CmsModelUrlParser $parser,
        CmsMessages $messages
    ) {
        parent::__construct($controller, $form);

        $this->parser = $parser;
        $this->messages = $messages;
    }

    /**
     * Form request validation rules
     *
     * @return array
     */
    public function rules(): array
    {
        return $this->form->getValidators();
    }
}
