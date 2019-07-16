<?php

use Cobra\Interfaces\Autoloader\ComposerAutoloaderInterface;

if (! function_exists('subclasses')) {
    /**
     * Gets the sub classes of a specific class in array format optionally
     * including the parent class.
     *
     * @param  string  $namespace
     * @param  boolean $parent
     * @return array
     */
    function subclasses(string $namespace, $parent = false): array
    {
        return container_object(ComposerAutoloaderInterface::class)->getSubclasses($namespace, $parent);
    }
}
