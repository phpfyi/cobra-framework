<?php

namespace Cobra\Model\ModelDataList;

use Iterator;
use Cobra\Interfaces\Model\ModelDataList\ModelDataListInterface;
use Cobra\Model\Traits\ModelDataListAccess;
use Cobra\Object\AbstractObject;

/**
 * Model Data List
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
class ModelDataList extends AbstractObject implements Iterator, ModelDataListInterface
{
    use ModelDataListAccess;

    /**
     * Sets the list data
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
