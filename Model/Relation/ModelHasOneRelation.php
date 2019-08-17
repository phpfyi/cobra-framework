<?php

namespace Cobra\Model\Relation;

use Cobra\Database\Relation\HasOneRelation;
use Cobra\Model\Model;

/**
 * Model Has One Relation
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
class ModelHasOneRelation extends HasOneRelation
{
    /**
     * Stores the has one record data
     *
     * @var Model
     */
    protected $data;

    /**
     * Returns the has one relation
     *
     * @return Model|null
     */
    public function get():? Model
    {
        $this->data = $this->relationClass::find('id', $this->relationID) ?: null;
        
        return $this->data;
    }

    /**
     * Dynamic method to allow accessing the object without calling get()
     *
     * @param  string $name
     * @return void
     */
    public function __get(string $name)
    {
        if (!$this->data) {
            $this->get();
        }
        return $this->data->$name;
    }
}
