<?php

namespace Cobra\Gtm\Event;

use Cobra\Interfaces\Auth\AuthInterface;
use Cobra\Interfaces\Gtm\GtmInterface;
use Cobra\Event\Event;

/**
 * GTM DataLayer Event
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
class GtmDataLayerEvent extends Event
{
    /**
     * GtmInterface instance
     *
     * @var GtmInterface
     */
    protected $gtm;

    /**
     * Auth instance
     *
     * @var Auth
     */
    protected $auth;

    /**
     * Sets the required inpage instance
     *
     * @param GtmInterface $gtm
     * @param AuthInterface $auth
     */
    public function __construct(GtmInterface $gtm, AuthInterface $auth)
    {
        $this->gtm = $gtm;
        $this->auth = $auth;
    }

    /**
     * Sets GTM dataLayaer data
     *
     * @return void
     */
    public function handle(): void
    {
        if ($user = $this->auth->getUser()) {
            $this->gtm->setData('UserID', $user->id);
        }
    }
}
