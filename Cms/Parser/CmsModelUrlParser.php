<?php

namespace Cobra\Cms\Parser;

use Cobra\Http\Uri\RequestUri;
use Cobra\Interfaces\Cms\Parser\CmsModelUrlParserInterface;
use Cobra\Model\Cache\ObjectCache;
use Cobra\Model\Model;
use Cobra\Object\AbstractObject;

/**
 * CMS Model Url Parser
 *
 * Handles the parsing of a CMS URL to determine the Model record to show.
 *
 * Traverses down through any amount of levels and relationships.
 * e.g
 * /cms/model/Page/update/1/Relation/update/1/AnotherRelation/create
 *
 * Runs checks to determine if the record is new or existing, whether the Model
 * is a top level or relation one.
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
class CmsModelUrlParser extends AbstractObject implements CmsModelUrlParserInterface
{
    /**
     * URL segments
     *
     * @var array
     */
    protected $segments = [];

    /**
     * ObjectCache instance
     *
     * @var ObjectCache
     */
    protected $objectCache;

    /**
     * URL record action
     *
     * @var string
     */
    protected $action;

    /**
     * URL record parent model
     *
     * @var Model
     */
    protected $parent;

    /**
     * URL record model
     *
     * @var Model
     */
    protected $record;

    /**
     * URL many relation instance
     *
     * @var object
     */
    protected $manyRelation;

    /**
     * Sets the required properties
     *
     * @param RequestUri $uri
     * @param ObjectCache $objectCache
     */
    public function __construct(RequestUri $uri, ObjectCache $objectCache)
    {
        $this->segments = array_filter(explode('/', $uri->getPath()));
        $this->objectCache = $objectCache;

        $this->setRecord();
    }

    /**
     * Returns the URL action
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Returns the URL record parent model
     *
     * @return Model
     */
    public function getParent(): Model
    {
        return $this->parent;
    }

    /**
     * Returns the URL record model
     *
     * @return Model
     */
    public function getRecord(): Model
    {
        return $this->record;
    }

    /**
     * Returns the URL many relation class
     *
     * @return string|null
     */
    public function getManyRelationClass():? string
    {
        return $this->manyRelationClass;
    }

    /**
     * Returns the URL many relation instance
     *
     * @return object|null
     */
    public function getManyRelation():? object
    {
        return $this->manyRelation;
    }

    /**
     * Sets a model record to edit based off the current URL
     *
     * Supports single record or many relation detection
     *
     * Also determines the action - create / update
     *
     * @return void
     */
    protected function setRecord(): void
    {
        array_shift($this->segments);
        array_shift($this->segments);

        $this->parseAction(array_shift($this->segments));
    }

    /**
     * Parses the URL action to return a record
     *
     * @param  string $table
     * @return void
     */
    protected function parseAction(string $table): void
    {
        $this->action = array_shift($this->segments);
        if ($this->action == 'create') {
            $this->setCreateRecord($table);
            return;
        }
        if (count($this->segments) > 0) {
            $this->setUpdateRecord($table, array_shift($this->segments));
            if (count($this->segments) > 0) {
                $this->traverse();
            }
        }
    }

    /**
     * Sets the record from a table name
     *
     * @param  string $table
     * @return void
     */
    protected function setCreateRecord(string $table): void
    {
        $this->record = $this->objectCache->getInstance($table);
    }

    /**
     * Returns a record based off the table name and ID
     *
     * @param  string  $table
     * @param  integer $recordId
     * @return void
     */
    protected function setUpdateRecord(string $table, int $recordId): void
    {
        $instance = $this->objectCache->getInstance($table);
        $this->record = $instance::find('id', $recordId);
    }

    /**
     * Traverses the record relations
     *
     * @return void
     */
    protected function traverse(): void
    {
        $this->parent = $this->record;
        $this->parseAction(
            $this->getRelationTable(
                array_shift($this->segments)
            )
        );
    }

    /**
     * Returns the relation table name
     *
     * @param  string $relation
     * @return string
     */
    protected function getRelationTable(string $relation): string
    {
        $relations = schema($this->parent)->relations();

        if ($relations->hasHasMany($relation)) {
            $this->manyRelation = $this->parent->$relation();
            $this->manyRelationClass = $this->manyRelation->getRelationClass();

            return $relations->get($relation)->relationTable;
        }
        if ($relations->hasManyMany($relation)) {
            $this->manyRelation = $this->parent->$relation();
            $this->manyRelationClass = $this->manyRelation->getForeignClass();

            return $relations->get($relation)->foreignTable;
        }
    }
}
