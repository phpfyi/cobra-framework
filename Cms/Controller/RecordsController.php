<?php

namespace Cobra\Cms\Controller;

use Cobra\Cms\Controller\AppController;
use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Model\ModelClassMap;

/**
 * CMS Records Controller
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
class RecordsController extends AppController
{
    /**
     * Build the CMS record list and renders the UI
     *
     * @param RequestInterface $request
     * @param ModelClassMap $classMap
     * @return void
     */
    public function read(RequestInterface $request, ModelClassMap $classMap): void
    {
        $model = $classMap->getInstance(
            $request->getUri()->getSegment(3)
        );
        $table = $model->cmsTable(
            container_resolve(
                ModelDataTableInterface::class,
                [
                    $model->getPlural(),
                    $model,
                    $model::get()->all()
                ]
            )
        );
        $table->getProps()
            ->set('basePath', config('cms.model_route').$model->getTable());
        
        view()
            ->setPage('apps.cms.view.page.records')
            ->setData('table', $table)
            ->setData('h1', $model->getPlural());
    }
}
