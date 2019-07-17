<?php

namespace Cobra\Asset\Resource;

use Cobra\Http\Stream\FileStream;
use Cobra\Http\Traits\OutputsHeaders;
use Cobra\Interfaces\Asset\FileInterface;
use Cobra\Interfaces\Asset\Resource\FileResourceInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Object\AbstractObject;
use Cobra\Server\FilePath;

/**
 * File Resource
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
class FileResource extends AbstractObject implements FileResourceInterface
{
    use OutputsHeaders;

    /**
     * File instance
     *
     * @var File
     */
    protected $file;

    /**
     * ResponseInterface instance
     *
     * @var ResponseInterface
     */
    protected $response;

    /**
     * Sets the file and response instances
     *
     * @param FileInterface $file
     * @param ResponseInterface $response
     */
    public function __construct(FileInterface $file, ResponseInterface $response)
    {
        $this->file = $file;
        $this->response = $response;
    }

    /**
     * Outputs the file headers and response.
     *
     * @return void
     */
    public function output(): void
    {
        $seconds = 60 * 60 * 24 * static::config('expiry_days');
        $expires = gmdate('D, d M Y H:i:s', time() + $seconds).' GMT';

        $this->response
            ->addHeader('Expires', $expires)
            ->addHeader('Cache-Control', 'must-revalidate')
            ->addHeader('Pragma', 'public')
            ->addHeader('Content-Length', $this->getContentLength())
            ->addHeader('Content-Type', $this->file->type);

        if ($this->file->class == File::class) {
            $this->response
                ->addHeader('Expires', '0')
                ->addHeader('Cache-Control', 'private')
                ->addHeader('Content-Description', 'File Transfer')
                ->addHeader(
                    'Content-Disposition',
                    sprintf(
                        'attachment; filename="%s"',
                        $this->file->filename
                    )
                );
        }
        $this->outputHeaders($this->response->getHeaders());

        http_response_code(200);
        
        echo FileStream::resolve($this->file->getAbsoluteSystemPath());
        exit();
    }

    /**
     * Returns the file content length.
     *
     * @return integer
     */
    protected function getContentLength(): int
    {
        return filesize(FilePath::joinRoot($this->file->system_path));
    }
}
