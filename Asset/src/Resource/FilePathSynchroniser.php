<?php

namespace Cobra\Asset\Resource;

use Cobra\Interfaces\Asset\Resource\FilePathSynchroniserInterface;
use Cobra\Interfaces\Asset\FileInterface;
use Cobra\Interfaces\Asset\FolderInterface;
use Cobra\Object\AbstractObject;
use Cobra\Server\File\FileSystem;
use Cobra\Server\File\FilePath;

/**
 * File Path Synchroniser
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
class FilePathSynchroniser extends AbstractObject implements FilePathSynchroniserInterface
{
    /**
     * FileInterface instance
     *
     * @var FileInterface
     */
    protected $file;

    /**
     * FolderInterface instance
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Public file path
     *
     * @var string
     */
    protected $publicPath;

    /**
     * System file path
     *
     * @var string
     */
    protected $systemPath;

    /**
     * Sets the file and folder instances
     *
     * @param FileInterface   $file
     * @param FolderInterface $folder
     */
    public function __construct(FileInterface $file, FolderInterface $folder)
    {
        $this->file = $file;
        $this->folder = $folder;
        $this->publicPath = $this->getAssetPath($this->file->public_path);
        $this->systemPath = $this->getAssetPath($this->file->system_path);
    }

    /**
     * Synchronises a file to its place in the file system.
     *
     * @return void
     */
    public function sync(): void
    {
        if ($this->isPathMismatch()) {
            FileSystem::move(
                FilePath::joinRoot($this->file->system_path),
                FilePath::joinRoot($this->systemPath)
            );
            $this->file->public_path = $this->publicPath;
            $this->file->system_path = $this->systemPath;
            $this->file->save();
        }
    }

    /**
     * Checks the file public and system paths are correct.
     *
     * @return boolean
     */
    protected function isPathMismatch(): bool
    {
        return $this->file->public_path != $this->publicPath || $this->file->system_path != $this->systemPath;
    }

    /**
     * Returns an absolute file path from a filename.
     *
     * @param  string $filename
     * @return string
     */
    protected function getAssetPath(string $filename): string
    {
        return uri_join_absolute(
            ASSETS_DIRECTORY,
            $this->folder->title,
            FilePath::basename($filename)
        );
    }
}
