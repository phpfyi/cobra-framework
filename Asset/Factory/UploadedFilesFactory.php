<?php

namespace Cobra\Asset\Factory;

use Cobra\Http\Resource\FileUpload;
use Cobra\Object\AbstractObject;

/**
 * Uploaded Files Factory
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
class UploadedFilesFactory extends AbstractObject
{
    /**
     * Array of UploadedFile instances
     *
     * @var array
     */
    protected $uploads = [];

    /**
     * File record class
     *
     * @var string
     */
    protected $class;

    /**
     * File record folder ID
     *
     * @var int
     */
    protected $folderID = 0;

    /**
     * Array of IDs of records successfully created
     *
     * @var array
     */
    protected $ids = [];

    /**
     * Sets the required properties
     *
     * @param array $uploads
     * @param string $class
     * @param integer $folderID
     */
    public function __construct(array $uploads, string $class, int $folderID)
    {
        $this->uploads = $uploads;
        $this->class = $class;
        $this->folderID = $folderID;
    }

    /**
     * Returns the uploded record IDs
     *
     * @return array
     */
    public function getIDs(): array
    {
        return $this->ids;
    }

    /**
     * Handles the array of uploaded files to create records from.
     *
     * @return UploadedFilesFactory
     */
    public function handle(): UploadedFilesFactory
    {
        array_map(
            function (FileUpload $upload) {
                $factory = container_resolve(
                    UploadedFileFactory::class,
                    [
                        $upload,
                        $this->class,
                        $this->folderID,
                        container_resolve(UploadPathFactory::class, [$upload, $this->folderID])
                    ]
                );
                $this->ids[] = $factory->getRecord()->id;
            },
            $this->uploads
        );
        return $this;
    }
}
