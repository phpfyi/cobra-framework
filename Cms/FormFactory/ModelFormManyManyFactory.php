<?php

namespace Cobra\Cms\FormFactory;

use Cobra\Interfaces\Asset\FileInterface;
use Cobra\Interfaces\Asset\Form\Field\UploadFieldInterface;
use Cobra\Interfaces\Database\Relation\ManyManyRelationInterface;
use Cobra\Model\Model;

/**
 * Model Form Many Many Factory
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
class ModelFormManyManyFactory extends ModelFormManyFactory
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
            function ($name, $relation) {
                $this->isFileRelation($relation->getForeignClass(true))
                ? $this->setUploader($name, $relation)
                : $this->setTable($name, $relation);
            },
            array_keys($this->relations),
            $this->relations
        );

        $this->form->setAfter($this->form->getAfter().implode($this->tables));
    }

    /**
     * Checks if the relation is a File class instance
     *
     * @param  string $namespace
     * @return boolean
     */
    private function isFileRelation(Model $model): bool
    {
        return $model instanceof $this->fileClass;
    }

    /**
     * Sets a many many file uploader element
     *
     * @param  string $name
     * @param  ManyManyRelationInterface $relation
     * @return void
     */
    private function setUploader(string $name, ManyManyRelationInterface $relation): void
    {
        $uploader = container_resolve(
                UploadFieldInterface::class,
                [
                    $name
                ]
            )
            ->setMultiple(true)
            ->setFiles($this->record->$name())
            ->setFileClass($relation->getForeignClass());

        $uploader->getProps()
            ->set('parent-class', get_class($this->record))
            ->set('parent-id', $this->record->id);

        $this->form->setField($uploader);
    }

    /**
     * Sets a form many many table
     *
     * @param  string $name
     * @param  ManyManyRelationInterface $relation
     * @return void
     */
    private function setTable(string $name, ManyManyRelationInterface $relation): void
    {
        $this->setManyTable(
            $name,
            $relation->getForeignClass(true),
            $this->record->$name()
        );
    }
}
