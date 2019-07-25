<?php

namespace Cobra\Environment;

use Cobra\Interfaces\Environment\EnvironmentDataInterface;
use Cobra\Environment\Exception\MissingEnvironmentFileException;
use Cobra\Object\AbstractObject;

/**
 * Environment Data
 *
 * Loads the contents of the envuironment file and merges it with the server
 * environment variables.
 *
 * @category  Environment
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class EnvironmentData extends AbstractObject implements EnvironmentDataInterface
{
    /**
     * Environment file path
     *
     * @var string
     */
    protected $path;

    /**
     * Environment data
     *
     * @var array
     */
    protected $data = [];
    
    /**
     * Sets the core environment file path
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Loads the environment data and returns it as an array.
     *
     * @throws MissingEnvironmentFileException
     * @return array
     */
    public function load(): array
    {
        if (!$file = stream_resolve_include_path($this->path)) {
            throw new MissingEnvironmentFileException(
                sprintf('Cannot find environment file: %s', $this->path)
            );
        }
        return array_merge(
            yaml_parse_file($file),
            getenv()
        );
    }
}
