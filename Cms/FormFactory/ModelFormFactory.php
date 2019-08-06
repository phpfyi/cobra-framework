<?php

namespace Cobra\Cms\FormFactory;

use Cobra\Interfaces\Form\FormInterface;
use Cobra\Interfaces\Form\FormFactoryInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\View\Loader\ViewLoaderInterface;
use Cobra\Model\Model;
use Cobra\Object\AbstractObject;

/**
 * Model Form Factory
 *
 * Converts a model to a editable record UI
 *
 * Form request handling logic is abstracted out of this class and it only deals
 * with the view presentation
 *
 * Creates a form with all the model properties / database columns converted to
 * form inputs
 *
 * Traverses the class hierarchy and creates fields for all models
 *
 * Has one relations are rendered as select fields with the relation populated
 *
 * Generates data tables for has many and many many relations
 *
 * Individual fields can be overridden in the model child class @method cmsForm()
 * and customized as required.
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
class ModelFormFactory extends AbstractObject implements FormFactoryInterface
{
    /**
     * Model instance
     *
     * @var Model
     */
    protected $model;

    /**
     * The request instance
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * Array of form data
     *
     * @var array
     */
    protected $data = [];

    /**
     * FormInterface instance
     *
     * @var FormInterface
     */
    protected $form;

    /**
     * Sets the model namespace, request instance, and base data
     *
     * @param Model                  $model
     * @param RequestInterface $request
     * @param array                  $data
     */
    public function __construct(Model $model, RequestInterface $request, array $data = [])
    {
        $this->model = $model;
        $this->request = $request;
        $this->data = (array) $data;
    }

    /**
     * Returns the complete rendered UI with form and relations
     *
     * Builds the default form fields first then loops through the user defined
     * fields and overwrites them as required
     *
     * Submit actions and security based fields are added to the form after
     * fields are added
     *
     * Form data is applied as the last step in the build process before
     * returning the form
     *
     * @return FormInterface
     */
    public function getForm(): FormInterface
    {
        $this->form = container_resolve(FormInterface::class, [
            $this->model->getTable()
        ]);

        // loop through the model hierarchy and set the default fields
        array_map(
            function ($namespace) {
                $model = singleton($namespace);

                $this->setColumnFields($model);

                if (array_key_exists('id', $this->data)) {
                    $this->setManyFields($model);
                    return;
                }
                $this->form->setAfter(
                    container_resolve(
                        ViewLoaderInterface::class,
                        [
                            'templates.Cms.CmsAddingRelations'
                        ]
                    )->getOutput()
                );
            },
            schema($this->model)->hierarchy(true)
        );
        // add tokens fields and submit button
        $this->form = container_resolve(
            FormFactoryInterface::class,
            [
                $this->form
            ]
        )->getForm();
                
        // update label
        $this->form->getField('id')->setLabel('ID');

        // set unassignable
        $this->setUnassignable();

        // overwrite constructed fields with user defined implementation
        $this->model->cmsForm($this->form);

        // set form values
        $this->form->setValues($this->data);

        return $this->form;
    }

    /**
     * Sets the database column fields.
     *
     * @param Model $model
     * @return void
     */
    protected function setColumnFields(Model $model): void
    {
        // set fields
        $factory = ModelFormColumnFactory::resolve(
            $this->form,
            schema($model)->columns()->getColumns()
        )->pushToForm();

        // set has one fields
        $factory = ModelFormHasOneFactory::resolve(
            $this->form,
            schema($model)->columns()->getHasOneColumns()
        )->pushToForm();
    }

    /**
     * Sets the database relation tables.
     *
     * @param Model $model
     * @return void
     */
    protected function setManyFields(Model $model): void
    {
        // has many fields
        $factory = ModelFormHasManyFactory::resolve(
            $this->form,
            databaseTable($model)->getHasManyRelations(),
            $this->model,
            $this->request->getUri()->getPath()
        )->pushToForm();

        // many many fields
        $factory = ModelFormManyManyFactory::resolve(
            $this->form,
            databaseTable($model)->getManyManyRelations(),
            $this->model,
            $this->request->getUri()->getPath()
        )->pushToForm();
    }

    /**
     * Sets fields as disabled based off the unassignable config.
     *
     * @return void
     */
    protected function setUnassignable(): void
    {
        array_map(
            function ($name) {
                $this->form
                    ->getField($name)
                    ->setDisabled();
            },
            $this->model->getUnassignable()
        );
    }
}
