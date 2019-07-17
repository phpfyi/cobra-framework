<?php

namespace Cobra\Asset\Controller;

use Cobra\Asset\File;
use Cobra\Interfaces\Http\Uri\RequestUriInterface;
use Cobra\Controller\Controller;

/**
 * Asset Controller
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
class AssetController extends Controller
{
    /**
     * Sends a file response
     *
     * @param RequestUriInterface $uri
     * @return void
     */
    public function get(RequestUriInterface $uri)
    {
        $file = File::find('public_path', $uri->getPath());
        
        if (!$file) {
            return $this->setHttpError(404);
        }
        $file->getResource()->output();
    }
}
