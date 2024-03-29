<?php

namespace Cobra\Http\Factory;

use Cobra\Asset\File;
use Cobra\Http\Stream\Stream;
use Cobra\Http\Stream\FileStream;
use Cobra\Http\Stream\HtmlStream;
use Cobra\Http\Stream\JsonStream;
use Cobra\Http\Stream\XmlStream;
use Cobra\Interfaces\Asset\FileInterface;
use Cobra\Interfaces\Controller\ControllerInterface;
use Cobra\Interfaces\Http\Factory\ContentFactoryInterface;
use Cobra\Object\AbstractObject;

/**
 * Content Factory
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
class ContentFactory extends AbstractObject implements ContentFactoryInterface
{
    /**
     * ControllerInterface variable
     *
     * @var ControllerInterface
     */
    protected $controller;

    /**
     * Sets the required properties.
     *
     * @param ControllerInterface $controller
     */
    public function __construct(ControllerInterface $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Returns a HtmlStream object.
     *
     * @param string $output
     * @return HtmlStream
     */
    public function html(string $output): HtmlStream
    {
        $this->controller
            ->getResponse()
            ->addHeader('Content-type', 'text/html;charset=UTF-8');
        
        return $this->write(HtmlStream::class, $output);
    }

    /**
     * Returns a JsonStream object.
     *
     * @param string $output
     * @return JsonStream
     */
    public function json(array $output): JsonStream
    {
        $this->controller
            ->getResponse()
            ->addHeader('Content-type', 'application/json');
        
        return $this->write(JsonStream::class, $output);
    }

    /**
     * Returns a XmlStream object.
     *
     * @param string $output
     * @return XmlStream
     */
    public function xml(string $output): XmlStream
    {
        $this->controller
            ->getResponse()
            ->addHeader('Content-type', 'text/xml');
        
        return $this->write(XmlStream::class, $output);
    }

    /**
     * Returns a FileStream object.
     *
     * @param FileInterface $file
     * @return FileStream
     */
    public function file(FileInterface $file): FileStream
    {
        $stream = $this->write(FileStream::class, $file);

        $this->controller
            ->getResponse()
                ->addHeader('Expires', $stream->getExpires())
                ->addHeader('Cache-Control', 'must-revalidate')
                ->addHeader('Pragma', 'public')
                ->addHeader('Content-Length', $stream->getContentLength())
                ->addHeader('Content-Type', $file->type);

        if ($file->class === File::class) {
            $this->controller
                ->getResponse()
                    ->addHeader('Expires', '0')
                    ->addHeader('Cache-Control', 'private')
                    ->addHeader('Content-Description', 'File Transfer')
                    ->addHeader(
                        'Content-Disposition',
                        sprintf(
                            'attachment; filename="%s"',
                            $file->filename
                        )
                    );
        }
        return $stream;
    }
    
    /**
     * Writes data to a stream and returns the stream object.
     *
     * @param string $namespace
     * @param mixed $output
     * @return Stream
     */
    protected function write(string $namespace, $output): Stream
    {
        return container_resolve($namespace, [$output]);
    }
}
