<?php

namespace Cobra\Auth\Password;

use Cobra\Interfaces\Auth\Password\PasswordGeneratorInterface;

/**
 * Password Generator
 *
 * @category  Auth
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class PasswordGenerator implements PasswordGeneratorInterface
{
    /**
     * Array of characters maps
     *
     * @var array
     */
    protected $characterSets = [
        'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'abcdefghijklmnopqrstuvwxyz',
        '0123456789',
        '@#$%^&+='
    ];
    
    /**
     * Password character array
     *
     * @var array
     */
    protected $password = [];

    /**
     * Length of the generated password
     *
     * @var integer
     */
    protected $length = 0;
    
    /**
     * Returns a generated password string
     *
     * @param  integer $length
     * @return string
     */
    public function create(int $length = 14): string
    {
        $this->length = $length;

        do {
            $this->sample();
        } while (count($this->password) < $length);

        return substr(str_shuffle(implode($this->password)), 0, $this->length);
    }
    
    /**
     * Samples the characters maps to set a random character to the password array
     *
     * @return void
     */
    protected function sample(): void
    {
        array_map(
            function ($set) {
                for ($i = 0; $i < $this->getCharacterCount(); $i++) {
                    $this->password[] = $this->getCharacterPosition($set);
                }
            },
            $this->characterSets
        );
    }
    
    /**
     * Get the number of charcters to sample from a character set
     *
     * @return integer
     */
    protected function getCharacterCount(): int
    {
        $chars = $this->getRandomFloor($this->getCharacterMax());
        return $chars == 0 ? 1 : $chars;
    }
    
    /**
     * Get a random whole number
     *
     * @param  integer $count
     * @return integer
     */
    protected function getRandomFloor(int $count): int
    {
        return (int) floor($this->getRandomFloat() * $count);
    }
    
    /**
     * Get a random float number
     *
     * @return float
     */
    protected function getRandomFloat(): float
    {
        return (float) sprintf('0.%s', random_int(0, 1000));
    }
    
    /**
     * Gets the maximum number of characters when evenly dividing the length by
     * the number of sets
     *
     * @return integer
     */
    protected function getCharacterMax(): int
    {
        return floor($this->length / count($this->characterSets)) + 1;
    }
    
    /**
     * Get a character from a random position in a character set string
     *
     * @param  string $set
     * @return string
     */
    protected function getCharacterPosition(string $set): string
    {
        $position = $this->getRandomFloor(strlen($set));
        $position = $position == 0 ? 1 : $position;
        return $set[$position];
    }
}
