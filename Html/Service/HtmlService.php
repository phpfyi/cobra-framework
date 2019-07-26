<?php

namespace Cobra\Html\Service;

use Cobra\Core\Service\Service;

/**
 * HTML Service
 *
 * @category  HTML
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class HtmlService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        contain_namespace(
            \Cobra\Interfaces\Html\HtmlInterface::class,
            \Cobra\Html\Html::class
        );
        contain_namespace(
            \Cobra\Interfaces\Html\HtmlElementInterface::class,
            \Cobra\Html\HtmlElement::class
        );
    }
}
