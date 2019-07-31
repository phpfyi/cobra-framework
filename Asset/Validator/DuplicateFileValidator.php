<?php

namespace Cobra\Asset\Validator;

use Cobra\Asset\Factory\UploadPathFactory;
use Cobra\Http\Resource\FileUpload;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Server\Storage\FileSystemInterface;
use Cobra\Validator\Validator;

/**
 * Duplicate File Validator
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
class DuplicateFileValidator extends Validator
{
    /**
     * Error message
     *
     * @var string
     */
    protected $message = 'File already exists at %s';

    /**
     * File record folder ID
     *
     * @var int
     */
    protected $folderID = 0;

    /**
     * Sets the required properties
     *
     * @param RequestInterface $request
     * @param FileSystemInterface $fileSystem
     */
    public function __construct(RequestInterface $request, FileSystemInterface $fileSystem)
    {
        $this->folderID = (int) $request->postVar('folder-id');
        $this->fileSystem = $fileSystem;
    }

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'cms-upload-duplicate';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  FileUpload $upload
     * @return bool
     */
    public function validate($upload): bool
    {
        $factory = container_resolve(
            UploadPathFactory::class,
            [$upload, $this->folderID]
        );
        $path = $factory->getAbsoluteFileSystemPath();

        if ($this->fileSystem->exists($path)) {
            $this->message = sprintf(
                $this->message,
                $factory->getFilePublicPath()
            );
            return false;
        }
        return true;
    }
}
