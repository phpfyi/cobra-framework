<?php

namespace Cobra\Http\Resource;

use Cobra\Http\Stream\UploadStream;
use Cobra\Interfaces\Server\Storage\FileSystemInterface;
use Cobra\Object\AbstractObject;
use Psr\Http\Message\UploadedFileInterface;

/**
 * File Upload
 *
 * Value object representing a file uploaded through an HTTP request.
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
class FileUpload extends AbstractObject implements UploadedFileInterface
{
    /**
     * File steam instance
     *
     * @var UploadStream
     */
    protected $stream;

    /**
     * FileSystemInterface instance
     *
     * @var FileSystemInterface
     */
    protected $fileSystem;

    /**
     * File temp name
     *
     * @var string|null
     */
    protected $tmpName;

    /**
     * File size
     *
     * @var int|null
     */
    protected $size = null;

    /**
     * Upload error code
     *
     * @var integer
     */
    protected $error = 0;
    
    /**
     * File name
     *
     * @var string|null
     */
    protected $filename = null;

    /**
     * Uploaded media type
     *
     * @var string|null
     */
    protected $clientMediaType = null;

    /**
     * Server parsed media type
     *
     * @var string|null
     */
    protected $serverMediaType = null;

    /**
     * File extension
     *
     * @var string|null
     */
    protected $extension = null;

    /**
     * Hashed filename
     *
     * @var string
     */
    protected $hash;

    /**
     * Sets the uploaded file data
     *
     * @param array $data
     * @param UploadStream $stream
     * @param FileSystemInterface $stream
     */
    public function __construct(
        array $data,
        UploadStream $stream,
        FileSystemInterface $fileSystem
    ) {
        $this->fileSystem = $fileSystem;

        $this->tmpName = array_key('tmp_name', $data);
        $this->size = array_key('size', $data);
        $this->error = array_key('error', $data);
        $this->filename = $this->fileSystem->basename(array_key('name', $data));
        $this->clientMediaType = array_key('type', $data);
        $this->serverMediaType = $this->tmpName ? mime_content_type($this->tmpName) : null;
        $this->extension = $fileSystem->extension($this->filename);
        $this->hash = md5($this->filename);

        $this->stream = $stream;
        $this->stream->write($this->tmpName ? $this->fileSystem->get($this->tmpName) : null);
    }

    /**
     * Retrieve a stream representing the uploaded file.
     *
     * This method MUST return a StreamInterface instance, representing the
     * uploaded file. The purpose of this method is to allow utilizing native PHP
     * stream functionality to manipulate the file upload, such as
     * stream_copy_to_stream() (though the result will need to be decorated in a
     * native PHP stream wrapper to work with such functions).
     *
     * If the moveTo() method has been called previously, this method MUST raise
     * an exception.
     *
     * @return StreamInterface Stream representation of the uploaded file.
     * @throws \RuntimeException in cases when no stream is available or can be
     *     created.
     */
    public function getStream(): UploadStream
    {
        return $this->stream;
    }

    /**
     * Move the uploaded file to a new location.
     *
     * Use this method as an alternative to move_uploaded_file(). This method is
     * guaranteed to work in both SAPI and non-SAPI environments.
     * Implementations must determine which environment they are in, and use the
     * appropriate method (move_uploaded_file(), rename(), or a stream
     * operation) to perform the operation.
     *
     * $targetPath may be an absolute path, or a relative path. If it is a
     * relative path, resolution should be the same as used by PHP's rename()
     * function.
     *
     * The original file or stream MUST be removed on completion.
     *
     * If this method is called more than once, any subsequent calls MUST raise
     * an exception.
     *
     * When used in an SAPI environment where $_FILES is populated, when writing
     * files via moveTo(), is_uploaded_file() and move_uploaded_file() SHOULD be
     * used to ensure permissions and upload status are verified correctly.
     *
     * If you wish to move to a stream, use getStream(), as SAPI operations
     * cannot guarantee writing to stream destinations.
     *
     * @see    http://php.net/is_uploaded_file
     * @see    http://php.net/move_uploaded_file
     * @param  string $targetPath Path to which to move the uploaded file.
     * @throws \InvalidArgumentException if the $targetPath specified is invalid.
     * @throws \RuntimeException on any error during the move operation, or on
     *     the second or subsequent call to the method.
     */
    public function moveTo($targetPath): bool
    {
        return $this->fileSystem->move($this->tmpName, $targetPath);
    }
    
    /**
     * Retrieve the file size.
     *
     * Implementations SHOULD return the value stored in the "size" key of
     * the file in the $_FILES array if available, as PHP calculates this based
     * on the actual size transmitted.
     *
     * @return integer|null The file size in bytes or null if unknown.
     */
    public function getSize():? int
    {
        return $this->size;
    }
    
    /**
     * Retrieve the error associated with the uploaded file.
     *
     * The return value MUST be one of PHP's UPLOAD_ERR_XXX constants.
     *
     * If the file was uploaded successfully, this method MUST return
     * UPLOAD_ERR_OK.
     *
     * Implementations SHOULD return the value stored in the "error" key of
     * the file in the $_FILES array.
     *
     * @see    http://php.net/manual/en/features.file-upload.errors.php
     * @return integer One of PHP's UPLOAD_ERR_XXX constants.
     */
    public function getError(): int
    {
        return $this->error;
    }
    
    /**
     * Retrieve the filename sent by the client.
     *
     * Do not trust the value returned by this method. A client could send
     * a malicious filename with the intention to corrupt or hack your
     * application.
     *
     * Implementations SHOULD return the value stored in the "name" key of
     * the file in the $_FILES array.
     *
     * @return string|null The filename sent by the client or null if none
     *     was provided.
     */
    public function getClientFilename():? string
    {
        return $this->filename;
    }
    
    /**
     * Retrieve the media type sent by the client.
     *
     * Do not trust the value returned by this method. A client could send
     * a malicious media type with the intention to corrupt or hack your
     * application.
     *
     * Implementations SHOULD return the value stored in the "type" key of
     * the file in the $_FILES array.
     *
     * @return string|null The media type sent by the client or null if none
     *     was provided.
     */
    public function getClientMediaType():? string
    {
        return $this->clientMediaType;
    }

    /**
     * Returns the file extension
     *
     * @return string|null
     */
    public function getExtension():? string
    {
        return $this->extension;
    }

    /**
     * Returns the server parsed media type
     *
     * @return string|null
     */
    public function getServerMediaType():? string
    {
        return $this->serverMediaType;
    }

    /**
     * Returns the hashed system filename
     *
     * @return string
     */
    public function getServerFilename(): string
    {
        return $this->hash.'.'.$this->extension;
    }
}
