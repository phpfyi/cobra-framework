<?php

namespace Cobra\Interfaces\Cms\Parser;

use Cobra\Model\Model;

/**
 * CMS Model URL Parser Interface
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
interface CmsModelUrlParserInterface
{
    /**
     * Returns the URL action
     *
     * @return string
     */
    public function getAction(): string;

    /**
     * Returns the URL record parent model
     *
     * @return Model
     */
    public function getParent(): Model;

    /**
     * Returns the URL record model
     *
     * @return Model
     */
    public function getRecord(): Model;

    /**
     * Returns the URL many relation class
     *
     * @return string|null
     */
    public function getManyRelationClass():? string;

    /**
     * Returns the URL many relation instance
     *
     * @return object|null
     */
    public function getManyRelation():? object;
}
