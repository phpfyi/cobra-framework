<?php

namespace Cobra\Asset\Service;

use Cobra\Core\Service\Service;

/**
 * Asset Service
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
class AssetService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        $this
            ->namespace(
                \Cobra\Interfaces\Asset\FileInterface::class,
                \Cobra\Asset\File::class
            )->namespace(
                \Cobra\Interfaces\Asset\FolderInterface::class,
                \Cobra\Asset\Folder::class
            )->namespace(
                \Cobra\Interfaces\Asset\ImageInterface::class,
                \Cobra\Asset\Image::class
            )->namespace(
                \Cobra\Interfaces\Asset\Form\Field\UploadFieldInterface::class,
                \Cobra\Asset\Form\Field\UploadField::class
            )->namespace(
                \Cobra\Interfaces\Asset\Resource\FilePathSynchroniserInterface::class,
                \Cobra\Asset\Resource\FilePathSynchroniser::class
            )->namespace(
                \Cobra\Interfaces\Asset\Resource\FileResourceInterface::class,
                \Cobra\Asset\Resource\FileResource::class
            );
    }
}
