<?php

namespace Cobra\Cms\Controller\DataTable;

use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableInterface;
use Cobra\Interfaces\Cms\Parser\CmsModelUrlParserInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Controller\Controller;
use Cobra\Http\Stream\HtmlStream;
use Cobra\Http\Uri\RequestUri;
use Cobra\Model\Model;
use Cobra\Model\Relation\ModelHasManyRelation;
use Cobra\Model\Relation\ModelManyManyRelation;

/**
 * CMS Action Controller
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
abstract class CmsAction extends Controller
{
    /**
     * Model URL parser instance
     *
     * @var CmsModelUrlParserInterface
     */
    protected $parser;

    /**
     * Array of post properties
     *
     * @var array
     */
    protected $properties = [
        'id',
        'class',
        'relation',
        'parentID',
        'parentClass',
        'action',
        'basePath'
    ];

    /**
     * Cms handler action after the index call
     *
     * @return void
     */
    abstract public function action();

    /**
     * Sets up the required POST vars
     *
     * @param  RequestInterface $request
     * @return void
     */
    public function index(RequestInterface $request)
    {
        if (!$request->isAjax()) {
            return;
        }
        array_map(
            function ($property) use ($request) {
                $this->{$property} = $request->postVar($property);
            },
            $this->properties
        );

        $this->parser = container_resolve(
            CmsModelUrlParserInterface::class,
            [
                RequestUri::resolve($this->basePath)
            ]
        );
        $this->action($request);
    }

    /**
     * Sets a table HTML response
     *
     * @param  Model $model
     * @param  mixed $data
     * @return void
     */
    protected function setTableResponse(Model $model, $data): void
    {
        $table = $model->cmsTable(
            container_resolve(
                ModelDataTableInterface::class,
                [
                    $this->isRelation($data) ? $data->getRelation() : $model->getPlural(),
                    $model,
                    $data
                ]
            )
        );
        $table->getProps()
            ->set('parentClass', $this->parentClass)
            ->set('parentID', $this->parentID)
            ->set('basePath', $this->basePath);

        $this->setResponseBody(HtmlStream::resolve(), $table);
    }

    /**
     * Checks if the data is a many relation
     *
     * @param  string $data
     * @return string
     */
    private function isRelation(Iterable $data): string
    {
        return $data instanceof ModelManyManyRelation || $data instanceof ModelHasManyRelation;
    }
}
