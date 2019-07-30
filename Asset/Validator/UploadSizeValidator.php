<?php

namespace Cobra\Asset\Validator;

use Cobra\Http\Resource\FileUpload;
use Cobra\Validator\Validator;

/**
 * Upload Size Validator
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
class UploadSizeValidator extends Validator
{
    /**
     * Max upload size
     *
     * @var int
     */
    protected $maxSize;

    /**
     * Sets the file factory instance and max upload size
     */
    public function __construct()
    {
        $this->maxSize = env('MAX_MB_UPLOAD_SIZE') * 1024 * 1024;
    }

    /**
     * Returns the validator name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'cms-upload-size';
    }

    /**
     * Main method to validate the passed value
     *
     * @param  FileUpload $upload
     * @return bool
     */
    public function validate($upload): bool
    {
        if ($upload->getSize() > $this->maxSize) {
            $this->message = 'Upload size is too large';
            return false;
        }
        if ($upload->getExtension() == 'php') {
            $this->message = 'Invalid file type';
            return false;
        }
        return true;
    }
}
