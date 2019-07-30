<?php

namespace Cobra\Asset\Controller;

use Cobra\Controller\Controller;
use Cobra\Interfaces\Asset\Form\Field\UploadFieldInterface;

/**
 * Upload Controller
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
class UploadController extends Controller
{
    /**
     * Array of current file uploader record IDs
     *
     * @var string
     */
    protected $recordsIds = [];

    /**
     * File record field or relation name
     *
     * @var string
     */
    protected $name;

    /**
     * File record class
     *
     * @var string
     */
    protected $class;

    /**
     * Whether multi upload request
     *
     * @var string
     */
    protected $multiple;

    /**
     * File record folder ID
     *
     * @var int
     */
    protected $folderID = 0;

    /**
     * Parent relation class
     *
     * @var string
     */
    protected $parentClass;

    /**
     * Parent relation ID
     *
     * @var int
     */
    protected $parentID;

    /**
     * Form field instance
     *
     * @var UploadFieldInterface
     */
    protected $uploader;

    /**
     * Controller setup method
     *
     * @return void
     */
    public function setup(): void
    {
        $this->recordsIds = array_filter((array) explode(',', $this->request->postVar('ids')));

        $this->name = $this->request->postVar('name');
        $this->class = $this->request->postVar('class');
        $this->multiple = $this->request->postVar('multiple') === 'true';
        $this->folderID = (int) $this->request->postVar('folder-id');

        $this->parentClass = $this->request->postVar('parent-class');
        $this->parentID = $this->request->postVar('parent-id');
    }
    
    /**
     * Sets the upload field instance
     *
     * @return UploadFieldInterface
     */
    protected function getUploader(): UploadFieldInterface
    {
        $this->uploader = container_resolve(
            UploadFieldInterface::class,
            [$this->name]
        );
        if ($this->multiple) {
            $this->uploader->setMultiple(true);
        }
        $this->uploader
            ->setFolderID($this->folderID)
            ->setFileClass($this->class)
            ->setValue($this->recordsIds);

        $this->uploader->getProps()
            ->set('parent-class', $this->parentClass)
            ->set('parent-id', $this->parentID);

        return $this->uploader;
    }
}
