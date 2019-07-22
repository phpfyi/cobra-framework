<?php

namespace Cobra\Cms\ModelDataTable;

use Cobra\Interfaces\Cms\ModelDataTable\ModelDataTableColumnInterface;
use Cobra\Object\AbstractObject;

/**
 * Model Data Table Search
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
class ModelDataTableColumn extends AbstractObject implements ModelDataTableColumnInterface
{
    /**
     * Column percent width
     *
     * @var integer
     */
    protected $width = 10;

    /**
     * Column heading
     *
     * @var string
     */
    protected $heading;

    /**
     * Column model property
     *
     * @var string
     */
    protected $property;

    /**
     * Sets the column properties
     *
     * @param integer $width
     * @param string  $heading
     * @param string  $property
     */
    public function __construct(int $width, string $heading, string $property)
    {
        $this->width = $width;
        $this->heading = $heading;
        $this->property = $property;
    }

    /**
     * Sets the column percent width
     *
     * @param  integer $width
     * @return ModelDataTableColumnInterface
     */
    public function setWidth(int $width): ModelDataTableColumnInterface
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Returns the column percent width
     *
     * @return integer
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * Sets the column heading
     *
     * @param  string $heading
     * @return ModelDataTableColumnInterface
     */
    public function setHeading(string $heading): ModelDataTableColumnInterface
    {
        $this->heading = $heading;
        return $this;
    }

    /**
     * Returns the column heading
     *
     * @return string
     */
    public function getHeading(): string
    {
        return $this->heading;
    }

    /**
     * Sets the column model property
     *
     * @param  string $property
     * @return ModelDataTableColumnInterface
     */
    public function setProperty(string $property): ModelDataTableColumnInterface
    {
        $this->property = $property;
        return $this;
    }

    /**
     * Returns the column model property
     *
     * @return string
     */
    public function getProperty(): string
    {
        return $this->property;
    }
}
