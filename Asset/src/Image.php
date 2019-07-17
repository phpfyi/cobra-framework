<?php

namespace Cobra\Asset;

use Cobra\Interfaces\Asset\ImageInterface;
use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTable;
use Cobra\Model\ModelDatabaseTable;

/**
 * Image
 *
 * @category  Asset
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class Image extends File implements ImageInterface
{
    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'Image';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'Image';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Images';

    /**
     * Whether to show in the CMS menu
     *
     * @var boolean
     */
    protected $inMenu = false;

    /**
     * Model database schema fields
     *
     * @param  ModelDatabaseTable $schema
     * @return ModelDatabaseTable
     */
    public function databaseTable(ModelDatabaseTable $schema): ModelDatabaseTable
    {
        // fields
        $schema->primary();
        $schema->created();
        $schema->varchar('url');
        $schema->int('width');
        $schema->int('height');

        return $schema;
    }

    /**
     * Returns the public path absolute URL
     *
     * @return string
     */
    public function getAbsoluteURL(): string
    {
        return uri_join_host($this->public_path);
    }
}
