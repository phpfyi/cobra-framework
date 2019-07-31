<?php

namespace Cobra\Asset\Factory;

use Cobra\Asset\Factory\UploadPathFactory;
use Cobra\Http\Resource\FileUpload;
use Cobra\Interfaces\Asset\ImageInterface;
use Cobra\Model\Model;
use Cobra\Object\AbstractObject;

/**
 * Uploaded File Factory
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
class UploadedFileFactory extends AbstractObject
{
    /**
     * FileUpload instance
     *
     * @var FileUpload
     */
    protected $upload;

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
     * UploadPathFactory instance
     *
     * @var UploadPathFactory
     */
    protected $pathFactory;

    /**
     * Model record instance
     *
     * @var Model
     */
    protected $record;

    /**
     * Sets the required properties
     *
     * @param FileUpload $upload
     * @param string $class
     * @param integer $folderID
     * @param UploadPathFactory $pathFactory
     */
    public function __construct(FileUpload $upload, string $class, int $folderID, UploadPathFactory $pathFactory)
    {
        $this->upload = $upload;
        $this->class = $class;
        $this->folderID = $folderID;
        $this->pathFactory = $pathFactory;
    }

    /**
     * Returns the created File model instance
     *
     * @return Model
     */
    public function getRecord(): Model
    {
        $this->upload->moveTo($this->pathFactory->getAbsoluteFileSystemPath());

        $this->record = $this->class::resolve();

        $this->record->class = $this->class;
        $this->record->folderID = $this->folderID;

        $this->record->size = $this->upload->getSize();
        $this->record->type = $this->upload->getServerMediaType();
        $this->record->filename = $this->upload->getClientFilename();
        $this->record->extension = $this->upload->getExtension();

        $this->record->public_path = '/'.$this->pathFactory->getFilePublicPath();
        $this->record->system_path = '/'.$this->pathFactory->getFileSystemPath();

        if ($this->record instanceof ImageInterface) {
            $this->setImageProperties();
        }
        $this->record->save();

        return $this->record;
    }

    /**
     * Sets the record image properties
     *
     * @return void
     */
    protected function setImageProperties(): void
    {
        $data = getimagesize($this->pathFactory->getAbsoluteFileSystemPath());
        if ($data) {
            $this->record->width = $data[0];
            $this->record->height = $data[1];
            $this->record->type = $data['mime'];
            return;
        }
        $this->record->type = mime_content_type($this->pathFactory->getAbsoluteFileSystemPath());
    }
}
