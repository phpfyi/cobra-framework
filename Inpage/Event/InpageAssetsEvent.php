<?php

namespace Cobra\Inpage\Event;

use Cobra\Interfaces\Inpage\InpageInterface;

/**
 * Inpage Assets Event
 *
 * Loads the required Inpage front end assets.
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
class InpageAssetsEvent extends InpageEvent
{
    /**
     * Sets the required inpage instance
     *
     * @param Inpage $inpage
     * @param View $view
     */
    public function __construct(InpageInterface $inpage)
    {
        parent::__construct($inpage);
    }

    /**
     * Sets the required inpage assets
     *
     * @return void
     */
    public function handle(): void
    {
        css()->setInline('inpage.main');

        javascript()->setFile('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
        javascript()->setFile('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
        javascript()->setBundle('dist/inpage');
    }
}
