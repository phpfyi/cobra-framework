<?php

namespace Cobra\Model\Middleware;

use Cobra\Http\Middleware\Middleware;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\Http\RequestHandlerInterface;
use Cobra\Model\Factory\DatabaseArchitect;
use Cobra\Model\Schema\SchemaFactory;

/**
 * Rebuild Database Middleware
 *
 * Flushes the model schema cache and rebuilds the database on each request.
 *
 * @category  Model
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class RebuildDatabaseMiddleware extends Middleware
{
    /**
     * SchemaFactory instance
     *
     * @var SchemaFactory
     */
    protected $schemaFactory = [];

    /**
     * DatabaseArchitect instance
     *
     * @var DatabaseArchitect
     */
    protected $databaseArchitect = [];

    /**
     * Sets the required properties
     *
     * @param SchemaFactory $schemaFactory
     * @param DatabaseArchitect $databaseArchitect
     */
    public function __construct(SchemaFactory $schemaFactory, DatabaseArchitect $databaseArchitect)
    {
        $this->schemaFactory = $schemaFactory;
        $this->databaseArchitect = $databaseArchitect;
    }

    /**
     * Flushes all config on each request
     *
     * @param  RequestInterface  $request
     * @param  RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(RequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (env('FLUSH_SCHEMA') === true) {
            $this->schemaFactory->cacheSchema();
            $this->databaseArchitect->createDatabase();
        }
        return $handler->handle($request);
    }
}
