<?php

namespace Cobra\Cms\Controller;

use Cobra\Cms\CmsModelUrlParser;
use Cobra\Cms\Controller\AppController;
use Cobra\Cms\Request\CreateBlockRequest;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Page\Form\PageBlockFormFactory;

/**
 * CMS Page Block Controller
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
class PageBlockRecordController extends AppController
{
    /**
     * View form instance
     *
     * @var Form
     */
    protected $form;

    /**
     * Creates a new block record and renders the UI
     *
     * @param  RequestInterface $request
     * @return void
     */
    public function create(RequestInterface $request)
    {
        $this->form = PageBlockFormFactory::resolve($request)->getForm();

        $request = CreateBlockRequest::resolve(
            $this,
            $this->form,
            CmsModelUrlParser::resolve($request->getUri())
        );
        $request->process();
        
        view()
            ->setPage('apps.cms.view.page.block')
            ->setData('h1', 'Page Block Selection')
            ->setData('form', $this->form);
    }
}
