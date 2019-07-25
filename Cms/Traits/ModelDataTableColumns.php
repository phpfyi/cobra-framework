<?php

namespace Cobra\Cms\Traits;

use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableInterface;

/**
 * Model Table Columns trait
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
trait ModelDataTableColumns
{
    /**
     * Model CMS table overrides
     *
     * @param  ModelDataTableInterface $table
     * @return ModelDataTableInterface
     */
    public function cmsTable(ModelDataTableInterface $table): ModelDataTableInterface
    {
        return $table->setColumns(static::config('table_columns'));
    }
}
