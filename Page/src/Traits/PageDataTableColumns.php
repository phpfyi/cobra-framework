<?php

namespace Cobra\Page\Traits;

use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableInterface;
use Cobra\Page\Page;

/**
 * Page Table Columns trait
 *
 * @category  Page
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait PageDataTableColumns
{
    /**
     * Model CMS table overrides
     *
     * @param  ModelDataTableInterface $table
     * @return ModelDataTableInterface
     */
    public function cmsTable(ModelDataTableInterface $table): ModelDataTableInterface
    {
        return $table->setColumns(Page::config('table_columns'));
    }
}
