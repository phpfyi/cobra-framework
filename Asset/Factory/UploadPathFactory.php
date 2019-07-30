<?php

namespace Cobra\Asset\Factory;

use Cobra\Http\Resource\FileUpload;
use Cobra\Interfaces\Asset\FolderInterface;
use Cobra\Interfaces\Server\Directory\DirectoryInterface;
use Cobra\Object\AbstractObject;

/**
 * Upload Path Factory
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
class UploadPathFactory extends AbstractObject
{
    /**
     * FileUpload instance
     *
     * @var FileUpload
     */
    protected $upload;

    /**
     * File record folder ID
     *
     * @var int
     */
    protected $folderID = 0;

    /**
     * DirectoryInterface variable
     *
     * @var DirectoryInterface
     */
    protected $directory;

    /**
     * FolderInterface variable
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Folder server path
     *
     * @var string
     */
    protected $folderPath;

    /**
     * Undocumented function
     *
     * @param FileUpload $upload
     * @param integer $folderID
     * @param DirectoryInterface $directory
     */
    public function __construct(FileUpload $upload, int $folderID, DirectoryInterface $directory)
    {
        $this->upload = $upload;
        $this->folderID = $folderID;
        $this->directory = $directory;

        $this->setupFolder();
    }

    /**
     * Returns the path Folder instance.
     *
     * @return FolderInterface|null
     */
    public function getFolder():? FolderInterface
    {
        return $this->folder;
    }

    /**
     * Returns the path folder ID.
     *
     * @return integer
     */
    public function getFolderID(): int
    {
        return $this->folderID;
    }

    /**
     * Rerturns the folder path.
     *
     * @return string
     */
    public function getFolderPath(): string
    {
        return $this->folderPath;
    }
    
    /**
     * Returns the absolute file system path
     *
     * @return string
     */
    public function getAbsoluteFileSystemPath(): string
    {
        return path_join_root($this->getFileSystemPath());
    }

    /**
     * Returns the relative file system path
     *
     * @return string
     */
    public function getFileSystemPath(): string
    {
        return $this->folderPath.$this->upload->getServerFilename();
    }

    /**
     * Returns the relative file public path
     *
     * @return string
     */
    public function getFilePublicPath(): string
    {
        return $this->folderPath.$this->upload->getClientFilename();
    }

    /**
     * Sets up the folder instance and folder server path.
     *
     * @return void
     */
    protected function setupFolder(): void
    {
        $this->folderPath = ASSETS_DIRECTORY.'/';

        if ($this->folderID > 0) {
            $this->folder = container_resolve(FolderInterface::class)->find('id', $this->folderID);
            $this->folderPath .= $this->folder->directory.'/';
        }
        $this->directory->create($this->folderPath);
    }
}
