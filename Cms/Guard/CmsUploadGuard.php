<?php

namespace Cobra\Cms\Guard;

use Cobra\Routing\Guard\RouteGuard;

/**
 * CMS Route Guard
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
class CmsUploadGuard extends RouteGuard
{
    /**
     * Returns whether the current route can be activated
     *
     * @return boolean
     */
    public function canActivate(): bool
    {
        if (!$this->auth->getUser()) {
            $this->response = http_forbidden_response($this);
            return false;
        }
        return true;
    }
}
