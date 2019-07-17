<?php

namespace Cobra\Gtm;

use Cobra\Interfaces\Gtm\GtmDataStoreInterface;
use Cobra\Object\AbstractObject;
use Cobra\Object\Traits\DataStore;

/**
 * Gtm Data Store
 *
 * Google Tag Manager dataLayer representation
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
class GtmDataStore extends AbstractObject implements GtmDataStoreInterface
{
    use DataStore;
}
