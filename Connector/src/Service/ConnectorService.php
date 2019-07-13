<?php

namespace Cobra\Connector\Service;

use Cobra\Connector\ConnectorRepository;
use Cobra\Connector\Exception\InvalidConnectorException;
use Cobra\Core\Service\Service;

/**
 * Connector Service
 *
 * Establish the database connection
 *
 * Non mandatory as setting DB_ENABLED to false in environment means
 * the application can run without a database connection.
 *
 * Upon successful connection the connection instance is pushed to
 * the ConnectorRepository instance and can be accessed in the application.
 *
 * @category  Connector
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ConnectorService extends Service
{
    /**
     * Returns whether the service is enabled
     *
     * @return bool
     */
    public function enabled(): bool
    {
        return env('DB_ENABLED') === true;
    }
    /**
     * Set up any service class instances required by the application.
     *
     * @throws InvalidConnectorException
     * @return void
     */
    public function instances(): void
    {
        $namespace = env('DB_CONNECTOR');
        if (!class_exists($namespace)) {
            throw new InvalidConnectorException(
                sprintf('No database connector class found for %s', $namespace)
            );
        }
        contain_object(
            \Cobra\Interfaces\Connector\ConnectorRepositoryInterface::class,
            \Cobra\Connector\ConnectorRepository::resolve(
                $namespace::resolve()
                    ->setErrors(env('ERRORS_ENABLED'))
                    ->setHostname(env('DB_HOSTNAME'))
                    ->setDatabase(env('DB_DATABASE'))
                    ->setUsername(env('DB_USERNAME'))
                    ->setPassword(env('DB_PASSWORD'))
                    ->connect()
            )
        );
    }
}
