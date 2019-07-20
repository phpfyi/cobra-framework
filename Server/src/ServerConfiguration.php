<?php

namespace Cobra\Server;

use Cobra\Interfaces\Server\ServerConfigurationInterface;
use Cobra\Server\Exception\PhpConfigurationException;

/**
 * Server Configuration
 *
 * @category  Server
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ServerConfiguration implements ServerConfigurationInterface
{
    /**
     * Min PHP version
     *
     * @var int
     */
    protected $minPhpVersion;

    /**
     * Max PHP version
     *
     * @var int
     */
    protected $maxPhpVersion;

    /**
     * Required PHP extensions
     *
     * @var array
     */
    protected $requiredExtensions = [];

    /**
     * Loaded PHP extensions
     *
     * @var array
     */
    protected $loadedExtensions = [];

    /**
     * Sets the required compare values
     *
     * @param string $minPhpVersion
     * @param string $maxPhpVersion
     * @param array $requiredExtensions
     */
    public function __construct(
        string $minPhpVersion,
        string $maxPhpVersion,
        array $requiredExtensions
    ) {
        $this->minPhpVersion = $minPhpVersion;
        $this->maxPhpVersion = $maxPhpVersion;
        $this->requiredExtensions = $requiredExtensions;

        $this->loadedExtensions = get_loaded_extensions();
    }

    /**
     * Checks the PHP version is supported
     *
     * Checks that the required PHP extensions are present
     *
     * @return void
     * @throws PhpConfigurationException
     */
    public function verify(): void
    {
        if (version_compare(PHP_VERSION, $this->minPhpVersion, '<')) {
            throw new PhpConfigurationException(
                sprintf('PHP version greater than %s+ required', $this->minPhpVersion)
            );
        }
        if (version_compare(PHP_VERSION, $this->maxPhpVersion, '>')) {
            throw new PhpConfigurationException(
                sprintf('PHP version less than %s required', $this->maxPhpVersion)
            );
        }
        array_map(
            function ($extension) {
                if (!in_array($extension, $this->loadedExtensions)) {
                    throw new PhpConfigurationException(
                        sprintf('%s php extension required', $extension)
                    );
                }
            },
            $this->requiredExtensions
        );
    }
}
