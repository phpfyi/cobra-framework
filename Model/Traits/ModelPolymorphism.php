<?php

namespace Cobra\Model\Traits;

use Cobra\Model\Model;

/**
 * Model Polymorphism trait
 *
 * @category  Model
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait ModelPolymorphism
{
    /**
     * Returns whether the model is polymorphic and must be re-queried
     *
     * @param  Model $record
     * @return boolean
     */
    private function isPolymorphic(Model $record): bool
    {
        return isset($record->class) && $record->class && !$record instanceof $record->class;
    }

    /**
     * Returns a transformed array of models
     *
     * @param  array $records
     * @return array
     */
    private function runPolymorphismArray(array $records = []): array
    {
        return array_map(
            function ($record) {
                return $this->runPolymorphism($record);
            },
            $records
        );
    }

    /**
     * Returns a transformed model
     *
     * @param  Model $record
     * @return Model|null
     */
    private function runPolymorphism($record = null)
    {
        if ($record) {
            if ($this->isPolymorphic($record)) {
                $record = $record->class::find('id', $record->id);
            }
            if (method_exists($record, 'afterFetch')) {
                $record->afterFetch();
            }
        }
        return $record;
    }
}
