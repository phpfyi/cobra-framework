<?php

namespace Cobra\Asset\Form\Field;

use Cobra\Asset\File;
use Cobra\Interfaces\Asset\FileInterface;
use Cobra\Interfaces\Asset\FolderInterface;
use Cobra\Interfaces\Asset\Form\Field\UploadFieldInterface;
use Cobra\Interfaces\Form\Field\FormFieldInterface;
use Cobra\Interfaces\Object\Props\PropsDataInterface;
use Cobra\Interfaces\View\ViewObject;
use Cobra\Form\Field\FormField;
use Cobra\Object\Traits\UsesProps;

/**
 * File Field
 *
 * @category  Form
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class UploadField extends FormField implements UploadFieldInterface, ViewObject
{
    use UsesProps;

    /**
     * Default field parameters
     *
     * @var array
     */
    protected $attributes = [
        'type'  => 'file',
        'class' => 'field field-upload'
    ];

    /**
     * Template to render the form field in
     *
     * @var string
     */
    protected $template = 'templates.Asset.Form.Field.UploadField';

    /**
     * Template field holder class
     *
     * @var string
     */
    protected $holderClass = 'form-field-holder form-upload-holder';

    /**
     * The File class namespace
     *
     * @var string
     */
    protected $fileClass = File::class;

    /**
     * Array of File objects
     *
     * @var array
     */
    protected $files = [];

    /**
     * FolderInterface instance
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Allow multiple uploads
     *
     * @var boolean
     */
    protected $multiple = false;

    /**
     * Sets up the File field
     *
     * @param string $name
     * @param string $label
     * @param int    $value
     * @param PropsDataInterface $data
     */
    public function __construct(string $name, $label = '', $value = null, PropsDataInterface $data)
    {
        parent::__construct($name, $label);

        $this->setValue($value);
        $this->setProps($data);

        $this->props
            ->set('ids', [])
            ->set('name', $name)
            ->set('class', $this->fileClass)
            ->set('folder-id', 0)
            ->set('search-class', File::class);
    }

    /**
     * Sets the field value.
     *
     * Escapes input by default but can be overridden by passing false as the
     * second argument
     *
     * @param  mixed   $value
     * @param  boolean $escape
     * @return FormFieldInterface
     */
    public function setValue($value, $escape = true): FormFieldInterface
    {
        $this->files = [];

        if (is_iterable($value)) {
            array_map(
                function ($item) {
                    $this->files[] = $item instanceof FileInterface
                    ? $item
                    : container_resolve(FileInterface::class)->find('id', $item);
                },
                is_array($value) ? $value : iterator_to_array($value)
            );
            return $this;
        }
        parent::setValue((int) $value, $escape);

        if ($this->value > 0 && $file = container_resolve(FileInterface::class)->find('id', $this->value)) {
            $this->files[] = $file;
        }
        return $this;
    }

    /**
     * Sets the model file class
     *
     * @param  string $class
     * @return UploadFieldInterface
     */
    public function setFileClass(string $class): UploadFieldInterface
    {
        $this->fileClass = $class;
        $this->props->set('class', $this->fileClass);

        return $this;
    }
    
    /**
     * Sets the upload field files
     *
     * @param  iterable $files
     * @return UploadFieldInterface
     */
    public function setFiles(iterable $files): UploadFieldInterface
    {
        $this->setValue($files);

        return $this;
    }
    
    /**
     * Gets the upload field files
     *
     * @return iterable
     */
    public function getFiles(): iterable
    {
        return $this->files;
    }

    /**
     * Sets the folder record
     *
     * @param  FolderInterface $folder
     * @return UploadFieldInterface
     */
    public function setFolder(FolderInterface $folder): UploadFieldInterface
    {
        $this->folder = $folder;
        $this->props->set('folder-id', $folder->id);

        return $this;
    }

    /**
     * Sets the folder ID.
     *
     * @param integer $folderId
     * @return UploadFieldInterface
     */
    public function setFolderID(int $folderId): UploadFieldInterface
    {
        return $this->setFolder(
            container_resolve(FolderInterface::class)->find('id', $folderId)
        );
    }

    /**
     * Sets the folder record by name
     *
     * @param  string $name
     * @return UploadFieldInterface
     */
    public function setFolderName(string $name): UploadFieldInterface
    {
        return $this->setFolder(
            container_resolve(FolderInterface::class)->find('title', $name)
        );
    }

    /**
     * Returns the folder record or null
     *
     * @return FolderInterface|null
     */
    public function getFolder():? FolderInterface
    {
        return $this->folder;
    }

    /**
     * Sets whether to allow multiple uploads
     *
     * @param  boolean $multiple
     * @return UploadFieldInterface
     */
    public function setMultiple(bool $multiple): UploadFieldInterface
    {
        $this->multiple = $multiple;
        $this->attributes['multiple'] = 'multiple';
        $this->props->set('multiple', $multiple);

        return $this;
    }

    /**
     * Returns whether multiple uploads are allowed
     *
     * @return boolean
     */
    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    /**
     * Returns all set HTML attributes
     *
     * @return array
     */
    public function __toString(): string
    {
        $this->attributes['name'] = 'form_uploader';

        $this->props->set('ids', array_map(function (FileInterface $file) {
            return $file->id;
        }, $this->files));

        return parent::__toString();
    }

    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return array_merge(
            parent::getViewData(),
            [
                'props' => $this->getProps(),
                'files' => $this->getFiles(),
                'multiple' => $this->isMultiple(),
            ]
        );
    }
}
