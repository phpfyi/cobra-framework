<?php

namespace Cobra\Interfaces\Gtm;

/**
 * GTM Interface
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
interface GtmInterface
{
    /**
     * Creates a singleton instance of this class
     *
     * @return GtmInterface
     */
    public static function instance();

    /**
     * Returns the config store
     *
     * @param GtmDataStoreInterface
     * @return GtmInterface
     */
    public function setStore(GtmDataStoreInterface $store): GtmInterface;

    /**
     * Returns the config store
     *
     * @return GtmDataStoreInterface
     */
    public static function getStore(): GtmDataStoreInterface;

    /**
     * Sets a dataLayer key / value pair.
     *
     * @param  string $name
     * @param  mixed  $value
     * @return GtmInterface
     */
    public function setData(string $name, $value): GtmInterface;

    /**
     * Set a dataLayer event.
     *
     * @param  string $event
     * @return GtmInterface
     */
    public function setEvent(string $event): GtmInterface;

    /**
     * Returns the formatted json dataLayer.
     *
     * @return string
     */
    public function __toString(): string;
}
