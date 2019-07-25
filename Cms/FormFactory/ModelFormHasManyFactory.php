<?php

namespace Cobra\Cms\FormFactory;

use Cobra\Interfaces\Database\Relation\HasManyRelationInterface;

/**
 * Model Form Has Many Factory
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
class ModelFormHasManyFactory extends ModelFormManyFactory
{
    /**
     * Pushes the fields to the form
     *
     * @return void
     */
    public function pushToForm(): void
    {
        array_map(
            function ($name, $relation) {
                $this->setTable($name, $relation);
            },
            array_keys($this->relations),
            $this->relations
        );

        $this->form->setAfter(
            $this->form->getAfter() . implode($this->tables)
        );
    }

    /**
     * Sets a form has many table
     *
     * @param  string $name
     * @param  HasManyRelationInterface $relation
     * @return void
     */
    protected function setTable(string $name, HasManyRelationInterface $relation): void
    {
        $this->setManyTable(
            $name,
            $relation->getRelationClass(true),
            $this->record->$name()
        );
    }
}
