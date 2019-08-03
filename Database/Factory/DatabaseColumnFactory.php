<?php

namespace Cobra\Database\Factory;

use Cobra\Interfaces\Database\Field\DatabaseFieldInterface;
use Cobra\Object\AbstractObject;

/**
 * Database Column Factory
 *
 * @category  Database
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class DatabaseColumnFactory extends AbstractObject
{
    /**
     * DatabaseFieldInterface instance
     *
     * @var DatabaseFieldInterface
     */
    protected $column;

    /**
     * Whether to write a primary key
     *
     * @var bool
     */
    protected $primary;

    /**
     * Column SQL
     *
     * @var string
     */
    protected $sql;

    /**
     * Sets the required properties
     *
     * @param DatabaseFieldInterface $column
     * @param bool $primary
     */
    public function __construct(DatabaseFieldInterface $column, bool $primary = true)
    {
        $this->column = $column;
        $this->primary = $primary;
    }

    /**
     * Returns the column SQL
     *
     * @return string
     */
    public function getSQL(): string
    {
        $this->sql .= sprintf('`%s` ', $this->column->getName());
        $this->sql .= sprintf('%s%s ', $this->getType(), $this->getLength());
        $this->sql .= $this->column->isUnsigned() === true ? 'unsigned ' : '';
        $this->sql .= $this->column->isIncremented() === true ? 'AUTO_INCREMENT ' : '';
        if ($this->primary) {
            $this->sql .= $this->column->isPrimary() === true ? 'primary key ' : '';
        }
        $this->sql .= $this->column->isNull() === true ? 'NULL ' : '';
        $this->sql .= $this->column->isNotNull() === true ? 'NOT NULL ' : '';
        $this->sql .= $this->column->getDefault() ? sprintf('DEFAULT %s ', $this->column->getDefault()) : '';
        $this->sql .= $this->column->getOnUpdate() ? sprintf('ON UPDATE %s ', $this->column->getOnUpdate()) : '';

        return $this->sql.PHP_EOL;
    }

    /**
     * Returns the column type SQL.
     *
     * @return string
     */
    protected function getType(): string
    {
        return strtoupper($this->column->getType());
    }

    /**
     * Returns the column length SQL.
     *
     * @return string
     */
    protected function getLength(): string
    {
        return $this->column->getLength()
        ? sprintf('(%s)', $this->column->getLength())
        : '';
    }
}
