<?php

namespace Cobra\Http\Stream;

use Cobra\Asset\File;
use Cobra\Interfaces\Asset\FileInterface;
use Cobra\Interfaces\Server\File\FileSystemInterface;

/**
 * File Stream
 *
 * @category  HTTP
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class FileStream extends Stream
{
    /**
     * FileInterface instance
     *
     * @var FileInterface
     */
    protected $file;

    /**
     * FileSystemInterface instance
     *
     * @var FileSystemInterface
     */
    protected $fileSystem;

    /**
     * Sets the required properties.
     *
     * @param FileInterface $file
     * @param FileSystemInterface $fileSystem
     */
    public function __construct(FileInterface $file, FileSystemInterface $fileSystem)
    {
        $this->file = $file;
        $this->fileSystem = $fileSystem;

        $this->data = $this->fileSystem->get($file->getAbsoluteSystemPath());
    }

    /**
     * Returns the file expiry date.
     *
     * @return string
     */
    public function getExpires(): string
    {
        $seconds = 60 * 60 * 24 * File::config('expiry_days');
        return gmdate('D, d M Y H:i:s', time() + $seconds).' GMT';
    }

    /**
     * Returns the file content length.
     *
     * @return integer
     */
    public function getContentLength(): int
    {
        return $this->fileSystem->size(
            path_join_root($this->file->system_path)
        );
    }
}
