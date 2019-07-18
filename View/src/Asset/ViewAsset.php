<?php

namespace Cobra\View\Asset;

use Cobra\Interfaces\View\ViewInterface;
use Cobra\Object\AbstractObject;

/**
 * View Asset
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
class ViewAsset extends AbstractObject
{
    /**
     * ViewInterface instance
     *
     * @var ViewInterface
     */
    protected $view;

    /**
     * View instance
     *
     * @param ViewInterface $view
     */
    public function __construct(ViewInterface $view)
    {
        $this->view = $view;
    }
}
