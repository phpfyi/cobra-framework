<?php

namespace Cobra\Gtm;

use Cobra\Interfaces\Gtm\GtmInterface;
use Cobra\Interfaces\Gtm\GtmDataStoreInterface;
use Cobra\Interfaces\Object\SingletonInterface;
use Cobra\Object\Traits\SingletonMethods;

/**
 * Gtm
 *
 * THe main Google Tag Manager class
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
class Gtm implements GtmInterface, SingletonInterface
{
    use SingletonMethods;

    /**
     * Instance of self
     *
     * @var GtmInterface
     */
    protected static $instance;

    /**
     * GtmDataStoreInterface instance
     *
     * @var GtmDataStoreInterface
     */
    protected static $store;

    /**
     * Creates a singleton instance of this class
     *
     * @return GtmInterface
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * Returns the config store
     *
     * @param GtmDataStoreInterface
     * @return GtmInterface
     */
    public function setStore(GtmDataStoreInterface $store): GtmInterface
    {
        self::$store = $store;
        return self::$instance;
    }

    /**
     * Returns the config store
     *
     * @return GtmDataStoreInterface
     */
    public static function getStore(): GtmDataStoreInterface
    {
        return self::$store;
    }

    /**
     * Sets a dataLayer key / value pair.
     *
     * @param  string $name
     * @param  mixed  $value
     * @return GtmInterface
     */
    public function setData(string $name, $value): GtmInterface
    {
        self::$store->set($name, $value);
        return $this;
    }

    /**
     * Set a dataLayer event.
     *
     * @param  string $event
     * @return GtmInterface
     */
    public function setEvent(string $event): GtmInterface
    {
        self::$store->set('event', $event);
        return $this;
    }

    /**
     * Returns the formatted json dataLayer.
     *
     * @return string
     */
    public function __toString(): string
    {
        return json_encode([
            (array) self::$store->getData()
        ]);
    }
}
