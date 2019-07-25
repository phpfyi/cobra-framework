<?php

namespace Cobra\Validator;

use Closure;
use ReflectionClass;
use Cobra\Interfaces\Validator\ValidatorInterface;
use Cobra\Interfaces\Validator\ValidatorResolverInterface;
use Cobra\Object\AbstractObject;
use Cobra\Object\Exception\InvalidClassnameException;
use Cobra\Validator\Cache\ValidatorCache;

/**
 * Validator Resolver
 *
 * Resolves a validator object instance from a string identifier.
 *
 * @category  Validator
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ValidatorResolver extends AbstractObject implements ValidatorResolverInterface
{
    /**
     * ValidatorCache instance
     *
     * @var ValidatorCache
     */
    protected $cache;

    /**
     * Sets the required properties
     *
     * @param ValidatorCache $cache
     */
    public function __construct(ValidatorCache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Returns a validator instance based on a string identifier.
     *
     * @param string $name
     * @return ValidatorInterface
     * @throws InvalidClassnameException
     */
    public function get(string $name): ValidatorInterface
    {
        $classnames = json_decode(
            $this->cache->find(
                'validators',
                $this->getCacheCallback()
            )->get(),
            true
        );
        if (!array_key_exists($name, $classnames)) {
            throw new InvalidClassnameException(
                sprintf('Cannot find validator class for rule: %s', $name)
            );
        }

        return $classnames[$name]::resolve();
    }

    /**
     * Returns the closure to build the validator classname map for the cache.
     *
     * The validator class map is an assocaitive array in the format:
     * [name] => [classname]
     *
     * @return Closure
     */
    protected function getCacheCallback(): Closure
    {
        return function () {
            $classes = subclasses(Validator::class);

            return json_encode(array_combine(
                array_map(function (string $classname) {
                    return (new ReflectionClass($classname))
                        ->newInstanceWithoutConstructor()
                        ->getName();
                }, $classes),
                $classes
            ), JSON_PRETTY_PRINT);
        };
    }
}
