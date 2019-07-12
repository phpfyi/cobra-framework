<?php

namespace Cobra\Auth\Controller;

use Cobra\Gtm\Gtm;
use Cobra\Page\Controller\PageController;

/**
 * Auth Controller
 *
 * @category  Auth
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class AuthController extends PageController
{
    /**
     * Template file path
     *
     * @var string
     */
    protected $template = 'templates.Auth.Page';
    
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
        meta()->setTitle('Auth');
        meta()->setTag('description', 'Login');
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
        js()->setInline('min/shared/io');
        js()->setBundle('dist/auth');

        view()
            ->setData('container_id', config('website.gtm.container_id'))
            ->setData('datalayer', Gtm::instance());
    }

    /**
     * Returns the login page link
     *
     * @return string
     */
    protected function getLoginLink(): string
    {
        return sprintf(
            '<a href="%s">Back to Login</a>',
            config('auth.login_route')
        );
    }

    /**
     * Returns the reset password link
     *
     * @return string
     */
    protected function getResetLink(): string
    {
        return sprintf(
            '<a href="%s">Reset Password</a>',
            config('auth.reset_route')
        );
    }
}
