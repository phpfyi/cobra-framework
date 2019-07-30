<?php

namespace Cobra\Asset\Controller;

use Cobra\Http\Stream\HtmlStream;
use Cobra\Interfaces\Http\Message\RequestInterface;

/**
 * Upload Remove Controller
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
class UploadRemoveController extends UploadController
{
    /**
     * ID of the file record to remove
     *
     * @var string
     */
    protected $recordId;

    /**
     * Controller setup method
     *
     * @return void
     */
    public function setup(): void
    {
        parent::setup();

        $this->recordId = $this->request->postVar('id');
    }

    /**
     * Runs the upload remove action
     *
     * @param RequestInterface $request
     * @param HtmlStream $stream
     * @return HtmlStream|null
     */
    public function index(RequestInterface $request):? HtmlStream
    {
        if (!$request->isAjax()) {
            return null;
        }
        $this->recordsIds = $this->multiple
        ? array_diff($this->recordsIds, [$this->recordId])
        : [];

        if ($this->parentClass) {
            $this->parentClass::find('id', $this->parentID)
                ->{$this->name}()
                ->remove($this->recordId);
        }
        return output()->html($this->getUploader());
    }
}
