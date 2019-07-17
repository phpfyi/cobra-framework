<?php

namespace Cobra\Interfaces\Asset\Form\Field;

use Iterator;
use Cobra\Interfaces\Asset\FolderInterface;

/**
 * Upload Field Interface
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
interface UploadFieldInterface
{
    /**
     * Sets the model file class
     *
     * @param  string $class
     * @return UploadFieldInterface
     */
    public function setFileClass(string $class): UploadFieldInterface;
    
    /**
     * Sets the upload field files
     *
     * @param  Iterator $files
     * @return UploadFieldInterface
     */
    public function setFiles(Iterator $files): UploadFieldInterface;
    
    /**
     * Gets the upload field files
     *
     * @return Iterator
     */
    public function getFiles(): Iterator;

    /**
     * Sets the folder record by name
     *
     * @param  string $name
     * @return UploadFieldInterface
     */
    public function setFolderName(string $name): UploadFieldInterface;

    /**
     * Sets the folder record
     *
     * @param  FolderInterface $folder
     * @return UploadFieldInterface
     */
    public function setFolder(FolderInterface $folder): UploadFieldInterface;

    /**
     * Returns the folder record or null
     *
     * @return FolderInterface|null
     */
    public function getFolder():? FolderInterface;

    /**
     * Sets whether to allow multiple uploads
     *
     * @param  boolean $multiple
     * @return UploadFieldInterface
     */
    public function setMultiple(bool $multiple): UploadFieldInterface;

    /**
     * Returns whether multiple uploads are allowed
     *
     * @return boolean
     */
    public function isMultiple(): bool;
}
