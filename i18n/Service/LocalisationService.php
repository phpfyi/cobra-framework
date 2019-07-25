<?php

namespace Cobra\i18n\Service;

use Cobra\Core\Service\Service;

/**
 * Localisation Service
 *
 * @category  Localisation
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class LocalisationService extends Service
{
    /**
     * Bind namespace references to classes in the container.
     *
     * @return void
     */
    public function namespaces(): void
    {
        contain_namespace(
            \Cobra\Interfaces\i18n\LocalisationInterface::class,
            \Cobra\i18n\Localisation::class
        );
    }

    /**
     * Set up any service class instances required by the application.
     *
     * @return void
     */
    public function instances(): void
    {
        container_resolve(
            \Cobra\Interfaces\i18n\LocalisationInterface::class
        )->setTimezone(env('TIMEZONE'));
    }
}
