<?php

namespace Cobra\Inpage\Report;

use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Http\Traits\UsesRequest;
use Cobra\Http\Traits\UsesResponse;

/**
 * Inpage Headers Report
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
class InpageHeadersReport extends InpageReport
{
    use UsesRequest, UsesResponse;

    /**
     * The inpage UI template
     *
     * @var string
     */
    protected $template = 'templates.Inpage.Report.InpageHeadersReport';

    /**
     * Sets the required properties
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Returns the report name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Headers';
    }
}
