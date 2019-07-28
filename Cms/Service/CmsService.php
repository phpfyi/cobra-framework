<?php

namespace Cobra\Cms\Service;

use Cobra\Core\Service\Service;

/**
 * CMS Service
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
class CmsService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        $this
            ->namespace(
                \Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableInterface::class,
                \Cobra\Cms\ModelDataTable\ModelDataTable::class
            )->namespace(
                \Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableColumnInterface::class,
                \Cobra\Cms\ModelDataTable\ModelDataTableColumn::class
            )->namespace(
                \Cobra\Interfaces\Cms\Parser\CmsModelUrlParserInterface::class,
                \Cobra\Cms\Parser\CmsModelUrlParser::class
            );
    }
}
