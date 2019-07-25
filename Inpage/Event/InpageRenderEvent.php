<?php

namespace Cobra\Inpage\Event;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Inpage\InpageInterface;

/**
 * Inpage Render Event
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
class InpageRenderEvent extends InpageEvent
{

    /**
     * Request instance
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * Sets the required inpage instance
     *
     * @param InpageInterface $inpage
     * @param RequestInterface $request
     */
    public function __construct(InpageInterface $inpage, RequestInterface $request)
    {
        parent::__construct($inpage);

        $this->request = $request;
    }

    /**
     * Inserts the inpage HTML into the response HTML
     *
     * @param string $output
     * @return void
     */
    public function handle(string &$output): void
    {
        if (!$this->request->isAjax()) {
            $output = (string) str_replace(
                "</body",
                "{$this->inpage}</body",
                $output
            );
        }
    }
}
