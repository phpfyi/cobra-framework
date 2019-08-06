<?php

namespace Cobra\Cms\Controller;

use Cobra\Cms\Controller\AppController;
use Cobra\Cms\FormFactory\ModelFormFactory;
use Cobra\Cms\Request\RecordRequest;
use Cobra\Interfaces\Cms\Parser\CmsModelUrlParserInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Database\Relation\HasManyRelation;
use Cobra\Form\Form;
use Cobra\Model\Model;

/**
 * CMS Record Controller
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
class RecordController extends AppController
{
    /**
     * Record form instance
     *
     * @var Form
     */
    protected $form;

    /**
     * URL parser instance
     *
     * @var CmsModelUrlParserInterface
     */
    protected $parser;

    /**
     * Model record instance
     *
     * @var Model
     */
    protected $record;

    /**
     * URL parser Model relation
     *
     * @var mixed
     */
    protected $relation;

    /**
     * Returns the URL parser instance
     *
     * @return CmsModelUrlParserInterface
     */
    public function getUrlParser(): CmsModelUrlParserInterface
    {
        return $this->parser;
    }

    /**
     * Controller setup method
     *
     * @return void
     */
    public function setup(): void
    {
        parent::setup();

        $this->parser = container_resolve(
            CmsModelUrlParserInterface::class,
            [
                $this->getRequest()->getUri()
            ]
        );
        $this->record = $this->parser->getRecord();
        $this->relation = $this->parser->getManyRelation();

        $this->form = ModelFormFactory::resolve(
            $this->record,
            $this->getRequest(),
            $this->record->extract(true)
        )->getForm();

        if ($this->relation instanceof HasManyRelation) {
            foreach (database_table($this->record)->getHasOneRelations() as $hasOne) {
                if ($hasOne->getHasManyRelation() == $this->relation->getRelation()
                    && $hasOne->getRelationClass() == $this->relation->getParentClass()
                ) {
                    $this->form
                        ->getField($hasOne->getName())
                        ->setValue($this->parser->getParent()->id)
                        ->setReadonly();
                }
            }
        }
    }

    /**
     * Creates a new CMS Model record
     *
     * @param  RequestInterface $request
     * @return void
     */
    public function create(RequestInterface $request)
    {
        $request = RecordRequest::resolve($this, $this->form, $this->parser);
        $request->process();

        view()
            ->setPage('apps.cms.view.page.record')
            ->setData('h1', sprintf('Create %s', $this->record->getSingular()))
            ->setData('form', $this->form);
    }

    /**
     * Updates a CMS Model record
     *
     * @param  RequestInterface $request
     * @return void
     */
    public function update(RequestInterface $request)
    {
        $request = RecordRequest::resolve($this, $this->form, $this->parser);
        $request->process();

        view()
            ->setPage('apps.cms.view.page.record')
            ->setData('h1', sprintf('Update %s', $this->record->getSingular()))
            ->setData('form', $this->form);
    }
}
