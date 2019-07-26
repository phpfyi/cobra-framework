<?php

namespace Cobra\Asset\Controller;

use Cobra\Interfaces\Asset\FileInterface;
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
        $file = container_resolve(FileInterface::class)->find('public_path', $uri->getPath());
        
        if (!$file) {
            return $this->setHttpError(404);
        }
        $this->setResponse(
            $this->response->withBody(
                $file->getResource()->output()
            )
        );
    }
}
