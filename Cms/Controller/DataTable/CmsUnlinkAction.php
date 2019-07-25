<?php

namespace Cobra\Cms\Controller\DataTable;

use Cobra\Interfaces\Http\Message\RequestInterface;

/**
 * CMS Unlink Action Controller
 *
 * @category  CMS
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class CmsUnlinkAction extends CmsAction
{
    /**
     * Unlinks a relation record
     *
     * @param  RequestInterface $request
     * @return void
     */
    public function action(RequestInterface $request)
    {
        $this->parser->getManyRelation()->remove($this->id);
        $this->setTableResponse(
            singleton($this->parser->getManyRelationClass()),
            $this->parser->getManyRelation()->get()
        );
    }
}