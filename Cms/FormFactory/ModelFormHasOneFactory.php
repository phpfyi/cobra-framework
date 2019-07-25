<?php

namespace Cobra\Cms\FormFactory;

use Cobra\Form\Field\SelectField;
use Cobra\Interfaces\Asset\FileInterface;
use Cobra\Interfaces\Asset\Form\Field\UploadFieldInterface;

/**
 * Model Form Has One Factory
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
class ModelFormHasOneFactory extends ModelFormFieldFactory
{
    /**
     * File class namespace
     *
     * @var string
     */
    protected $fileClass = FileInterface::class;

    /**
     * Pushes the fields to the form
     *
     * @return void
     */
    public function pushToForm(): void
    {
        array_map(
            function ($relation, $column) {
                if ($this->isFileRelation($column->relationClass)) {
                    $element = container_resolve(
                        UploadFieldInterface::class,
                        [
                            $column->name, 
                            label_text($relation)
                        ]
                    );
                    $element->setFileClass($column->relationClass);
                } else {
                    $element = SelectField::resolve($column->name, label_text($relation));
                    $element->setData($this->getHasOneOptions($column->class));
                }
                $this->form->setField($element);
            },
            array_keys($this->columns),
            $this->columns
        );
    }

    /**
     * Checks if the relation is a File class instance
     *
     * @param  string $namespace
     * @return boolean
     */
    protected function isFileRelation(string $namespace): bool
    {
        return singleton($namespace) instanceof $this->fileClass;
    }
    
    /**
     * Create a list of has one select options in id => text format
     *
     * @param  string $namespace
     * @return array
     */
    protected function getHasOneOptions(string $namespace): array
    {
        $options = [];
        foreach ($namespace::get()->all() as $data) {
            $options[$data->id] = $data->title;
        }
        return $options;
    }
}
