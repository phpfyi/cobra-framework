<?php

namespace Cobra\Inpage\Event;

use Cobra\Event\Event;
use Cobra\Interfaces\Inpage\InpageInterface;

/**
 * Inpage Event
 *
 * @category  Inpage
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class InpageEvent extends Event
{
    /**
     * Sets the required inpage instance
     *
     * @param InpageInterface $inpage
     */
    public function __construct(InpageInterface $inpage)
    {
        $this->inpage = $inpage;
    }
}
