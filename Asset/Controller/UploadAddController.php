<?php

namespace Cobra\Asset\Controller;

use Cobra\Asset\Factory\UploadedFilesFactory;
use Cobra\Http\Stream\HtmlStream;
use Cobra\Interfaces\Http\Message\RequestInterface;

/**
 * Upload Add Controller
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
class UploadAddController extends UploadController
{
    /**
     * Array of upload validators
     *
     * @var array
     */
    protected $validators = [
        \Cobra\Asset\Validator\DuplicateFileValidator::class,
        \Cobra\Asset\Validator\UploadSizeValidator::class,
    ];

    /**
     * Adds a new file upload record
     *
     * @param RequestInterface $request
     * @return HtmlStream|null
     */
    public function index(RequestInterface $request):? HtmlStream
    {
        if (!$request->isAjax()) {
            return null;
        }
        $this->uploader = $this->getUploader();

        // validate uploads
        foreach ($request->getUploadedFiles() as $upload) {
            foreach ($this->validators as $namespace) {
                $validator = container_resolve($namespace);
    
                if (!$validator->validate($upload)) {
                    $this->uploader->setErrorMessage($validator->getMessage());
    
                    return output()->html($this->uploader);
                }
            }
        }
        // get upload record IDs
        $recordsIds = container_resolve(
            UploadedFilesFactory::class,
            [
                $request->getUploadedFiles(),
                $request->postVar('class'),
                (int) $request->postVar('folder-id')
            ]
        )->handle()->getIDs();

        // attach many relations
        if ($this->parentClass) {
            array_map(function (int $id) {
                $this->parentClass::find('id', $this->parentID)
                    ->{$this->name}()
                    ->add($id);
            }, $recordsIds);
        }
        $this->uploader->setValue(
            array_merge($this->recordsIds, $recordsIds)
        );
        return output()->html($this->uploader);
    }
}
