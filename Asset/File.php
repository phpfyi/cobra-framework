<?php

namespace Cobra\Asset;

use Cobra\Cms\Traits\ModelDataTableColumns;
use Cobra\Http\Stream\FileStream;
use Cobra\Interfaces\Asset\FileInterface;
use Cobra\Interfaces\Asset\Form\Field\UploadFieldInterface;
use Cobra\Interfaces\Asset\Resource\FilePathSynchroniserInterface;
use Cobra\Interfaces\Form\FormInterface;
use Cobra\Form\Field\SelectField;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;

/**
 * File
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
class File extends Model implements FileInterface
{
    use ModelDataTableColumns;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'File';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'File';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Files';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'file';

    /**
     * Whether to show in the CMS menu
     *
     * @var boolean
     */
    protected $inMenu = true;

    /**
     * FileStream resource
     *
     * @var FileStream
     */
    protected $resource;

    /**
     * Model database schema fields
     *
     * @param  ModelDatabaseTable $schema
     * @return ModelDatabaseTable
     */
    public function databaseTable(ModelDatabaseTable $schema): ModelDatabaseTable
    {
        // fields
        $schema->primary();
        $schema->created();
        $schema->updated();
        $schema->varchar('class');
        $schema->varchar('title');
        $schema->varchar('alt');
        $schema->varchar('filename');
        $schema->varchar('public_path');
        $schema->varchar('system_path');
        $schema->int('size');
        $schema->varchar('type');
        $schema->varchar('extension');
        // has one
        $schema->hasOne('folder', Folder::class, 'Files');

        return $schema;
    }

    /**
     * Model CMS form fields override
     *
     * @param  FormInterface $form
     * @return FormInterface
     */
    public function cmsForm(FormInterface $form): FormInterface
    {
        $form->insertBefore(
            'filename',
            SelectField::resolve(
                'class'
            )->setData(
                array_combine_from(
                    subclasses(static::class, true)
                )
            )
        );
        $this->id == 0
        ? $form->setField(container_resolve(
            UploadFieldInterface::class,
            [
                'public_path',
                'File'
            ]
        ))
        : $form->getField('public_path')->setReadonly();
        
        $form->setReadonly(['class', 'filename', 'system_path', 'size', 'type', 'extension']);
        $form->setValidators(static::config('validation_rules'));

        return $form;
    }

    /**
     * Returns the system file instance
     *
     * @return FileStream
     */
    public function getResource(): FileStream
    {
        if (!$this->resource) {
            $this->resource = container_resolve(FileStream::class, [$this]);
        }
        return $this->resource;
    }

    /**
     * Hook called after saving to database
     *
     * @return void
     */
    public function afterSave(): void
    {
        if ($this->folderID > 0) {
            container_resolve(
                FilePathSynchroniserInterface::class,
                [
                    $this,
                    $this->folder()->get()
                ]
            )->sync();
        }
        $this->resource = container_resolve(FileStream::class, [$this]);
    }

    /**
     * Returns the absolute system path
     *
     * @return string
     */
    public function getAbsoluteSystemPath(): string
    {
        return path_join_root($this->system_path);
    }
}
