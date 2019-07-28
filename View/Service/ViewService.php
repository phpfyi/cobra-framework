<?php

namespace Cobra\View\Service;

use Cobra\Core\Service\Service;

/**
 * View Service
 *
 * @category  View
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ViewService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        $this
            ->namespace(
                \Cobra\Interfaces\View\ViewInterface::class,
                \Cobra\View\View::class
            )->namespace(
                \Cobra\Interfaces\View\ViewDataInterface::class,
                \Cobra\View\ViewData::class
            )->namespace(
                \Cobra\Interfaces\View\Loader\ViewLoaderInterface::class,
                \Cobra\View\Loader\ViewLoader::class
            )->namespace(
                \Cobra\Interfaces\View\Loader\ScopedLoaderInterface::class,
                \Cobra\View\Loader\ScopedLoader::class
            )->namespace(
                \Cobra\Interfaces\View\Transform\ViewParserInterface::class,
                \Cobra\View\Transform\ViewParser::class
            )->namespace(
                \Cobra\Interfaces\View\Transform\ViewMinifierInterface::class,
                \Cobra\View\Transform\ViewParser::class
            )->namespace(
                \Cobra\Interfaces\View\Asset\ViewCssInterface::class,
                \Cobra\View\Asset\ViewCss::class
            )->namespace(
                \Cobra\Interfaces\View\Asset\ViewJavaScriptInterface::class,
                \Cobra\View\Asset\ViewJavaScript::class
            )->namespace(
                \Cobra\Interfaces\View\Asset\ViewMetaInterface::class,
                \Cobra\View\Asset\ViewMeta::class
            );
    }
}
