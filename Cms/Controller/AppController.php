<?php

namespace Cobra\Cms\Controller;

use Cobra\Core\Traits\VersionControl;
use Cobra\Interfaces\Cms\CmsMessagesInterface;
use Cobra\Interfaces\Gtm\GtmInterface;
use Cobra\Model\Factory\ClassFactory;
use Cobra\Page\Controller\PageController;

/**
 * CMS App Controller
 *
 * Main parent controller for all CMS controllers
 *
 * Sets some required default properties like Meta for the child controllers
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
class AppController extends PageController
{
    use VersionControl;

    /**
     * Array of menu items
     *
     * @var array
     */
    protected $menu = [];

    /**
     * Main cms view template
     *
     * @var string
     */
    protected $template = 'apps.cms.view.page';

    /**
     * Controller setup method
     *
     * @return void
     */
    public function setup(): void
    {
        parent::setup();

        // base tag
        meta()->setBaseTag(url());
        // other
        meta()->setTag('viewport', 'width=device-width,minimum-scale=1,initial-scale=1');
        meta()->setTag('format-detection', 'telephone=no');
        meta()->setTag('theme-color', '#0E91B7');
        // seo
        meta()->setTitle('CMS');
        meta()->setTag('description', 'CMS');
        meta()->setTag('robots', 'noindex,nofollow');
        meta()->setLink('canonical', URL);
        // icons
        meta()->setLink('icon', url('favicon.ico'), ['type' => 'image/x-icon']);
        meta()->setLink('shortcut icon', url('favicon.ico'), ['type' => 'image/x-icon']);
        meta()->setLink('apple-touch-icon', img('touch/touch-icon-iphone.png'), ['sizes' => '57x57']);
        meta()->setLink('apple-touch-icon', img('touch/touch-icon-ipad.png'), ['sizes' => '76x76']);
        meta()->setLink('apple-touch-icon', img('touch/touch-icon-iphone-retina.png'), ['sizes' => '120x120']);
        meta()->setLink('apple-touch-icon', img('touch/touch-icon-ipad-retina.png'), ['sizes' => '152x152']);
        // css
        css()->setInline('cms.main');
        // javascript
        javascript()->setInline('min/shared/io');
        javascript()->setFile('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
        javascript()->setFile('https://cloud.tinymce.com/stable/tinymce.min.js');
        javascript()->setInline('min/shared/jquery');
        javascript()->setFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js');
        javascript()->setBundle('dist/cms');

        view()
            ->setData('container_id', config('cms.gtm.container_id'))
            ->setData('datalayer', container_object(GtmInterface::class))
            ->setData('menu_models', $this->getMenu())
            ->setData('app_version', $this->getVersionNumber(1))
            ->setData('messages', container_object(CmsMessagesInterface::class)->setup());
    }

    /**
     * Returns the CMS menu
     *
     * @return array
     */
    protected function getMenu(): array
    {
        foreach (container_resolve(ClassFactory::class)->getReflectionClasses() as $model) {
            if ($model->getInMenu()) {
                $path = sprintf('%s%s/read', config('cms.model_route'), $model->getTable());
                $this->menu[$path] = $model->getPlural();
            }
        }
        return $this->menu;
    }
}
