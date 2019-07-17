<?php

namespace Cobra\Asset\Form\Field;

use ArrayIterator;
use Iterator;
use Cobra\Asset\File;
use Cobra\Asset\Folder;
use Cobra\Interfaces\Asset\FolderInterface;
use Cobra\Interfaces\Asset\Form\Field\UploadFieldInterface;
use Cobra\Interfaces\Form\Field\FormFieldInterface;
use Cobra\Interfaces\Object\Props\PropsDataInterface;
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
class UploadField extends FormField implements UploadFieldInterface
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
     * Folder record instance
     *
     * @var Folder
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
        parent::__construct($name, $label, $value);

        $this->setProps($data);
        $this->props
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
        if (is_array($value) || $value instanceof Iterator) {
            array_map(
                function ($id) {
                    $this->files[] = File::find('id', $id);
                },
                new ArrayIterator($value)
            );
        } else {
            parent::setValue($value);
            if ((int) $value > 0 && $file = File::find('id', $value)) {
                $this->files[] = $file;
            }
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
     * @param  Iterator $files
     * @return UploadFieldInterface
     */
    public function setFiles(Iterator $files): UploadFieldInterface
    {
        $this->files = $files;
        return $this;
    }
    
    /**
     * Gets the upload field files
     *
     * @return Iterator
     */
    public function getFiles(): Iterator
    {
        return $this->files;
    }

    /**
     * Sets the folder record by name
     *
     * @param  string $name
     * @return UploadFieldInterface
     */
    public function setFolderName(string $name): UploadFieldInterface
    {
        return $this->setFolder(Folder::find('title', $name));
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
        $this->attributes['multiple'] = 'multiple';
        $this->multiple = $multiple;
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
        return parent::__toString();
    }
}
