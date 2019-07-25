<?php

namespace Cobra\Interfaces\Cms\ModelDataTable;

/**
 * Model Data Table Column Interface
 *
 * @category  CMS
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
interface ModelDataTableColumnInterface
{
    /**
     * Sets the column percent width
     *
     * @param  integer $width
     * @return ModelDataTableColumnInterface
     */
    public function setWidth(int $width): ModelDataTableColumnInterface;

    /**
     * Returns the column percent width
     *
     * @return integer
     */
    public function getWidth(): int;

    /**
     * Sets the column heading
     *
     * @param  string $heading
     * @return ModelDataTableColumnInterface
     */
    public function setHeading(string $heading): ModelDataTableColumnInterface;

    /**
     * Returns the column heading
     *
     * @return string
     */
    public function getHeading(): string;

    /**
     * Sets the column model property
     *
     * @param  string $property
     * @return ModelDataTableColumnInterface
     */
    public function setProperty(string $property): ModelDataTableColumnInterface;

    /**
     * Returns the column model property
     *
     * @return string
     */
    public function getProperty(): string;
}
