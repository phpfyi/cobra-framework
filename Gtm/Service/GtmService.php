<?php

namespace Cobra\Gtm\Service;

use Cobra\Core\Service\Service;
use Cobra\Gtm\GtmDataStore;
use Cobra\Interfaces\Gtm\GtmInterface;

/**
 * GTM Service
 *
 * @category  GTM
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class GtmService extends Service
{
    /**
     * Array of app events
     *
     * @var array
     */
    protected $events = [
        'BeforeViewRendered' => [
            \Cobra\Gtm\Event\GtmDataLayerEvent::class
        ]
    ];

    /**
     * Set up any service class instances required by the application.
     *
     * @return void
     */
    public function instances(): void
    {
        $store = container_resolve(GtmDataStore::class);

        $this
            ->instance(
                \Cobra\Interfaces\Gtm\GtmInterface::class,
                \Cobra\Gtm\Gtm::class
            );

        container_object(
            \Cobra\Interfaces\Gtm\GtmInterface::class
        )->setStore($store);
    }
}
