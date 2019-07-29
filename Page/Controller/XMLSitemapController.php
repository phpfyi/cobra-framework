<?php

namespace Cobra\Page\Controller;

use Cobra\Controller\Controller;
use Cobra\Http\Stream\XmlStream;
use Cobra\Interfaces\Page\PageInterface;
use Cobra\Interfaces\Page\Sitemap\XMLSitemapBuilderInterface;

/**
 * XML Sitemap Controller
 *
 * @category  Page
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class XMLSitemapController extends Controller
{
    /**
     * Sets the XML sitemap response
     *
     * @return XmlStream
     */
    public function index(): XmlStream
    {
        $builder = container_resolve(
            XMLSitemapBuilderInterface::class,
            [
                iterator_to_array(
                    container_resolve(PageInterface::class)->get()->where('status', '=', 2)->all()
                )
            ]
        );
        return output()->xml($builder->getXML());
    }
}
