<?php

namespace Cobra\Form\Field;

use Cobra\Form\Field\FormField;

/**
 * Recaptcha Field
 *
 * @category  Form
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class RecaptchaField extends FormField
{
    /**
     * An identifier used for the tag
     *
     * @var string
     */
    protected $name = 'g-recaptcha-response';

    /**
     * Template to render the form field in
     *
     * @var string
     */
    protected $template = 'templates.Form.Field.RecaptchaField';

    /**
     * Form ID
     *
     * @var string
     */
    protected $formID;

    /**
     * Form submit ID
     *
     * @var string
     */
    protected $submitID;

    /**
     * Sets the form and submit ID
     *
     * @param string $formID
     * @param string $submitID
     */
    public function __construct(string $formID, string $submitID)
    {
        $this->formID = $formID;
        $this->submitID = $submitID;
        $this->attributes = [
            'name'  => $this->name,
            'value' => '',
            'id'    => 'field-'.$this->name,
            'class' => 'field field-recaptcha'
        ];
    }

    /**
     * Returns the form ID
     *
     * @return string
     */
    public function getFormID(): string
    {
        return $this->formID;
    }

    /**
     * Returns the form submit ID
     *
     * @return string
     */
    public function getSubmitID(): string
    {
        return $this->submitID;
    }

    /**
     * Returns the recaptcha sitekey
     *
     * @return string
     */
    public function getSiteKey(): string
    {
        return env('RECAPTCHA_SITE_KEY');
    }

    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return array_merge(
            parent::getViewData(),
            [
                'form_id' => $this->getFormID(),
                'submit_id' => $this->getSubmitID(),
                'site_key' => $this->getSiteKey(),
            ]
        );
    }
}
