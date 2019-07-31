<?php

namespace Cobra\Auth\Controller;

use Cobra\Controller\Controller;
use Cobra\Http\Stream\HtmlStream;
use Cobra\Interfaces\Auth\Password\PasswordGeneratorInterface;

/**
 * Password Controller
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
class GeneratePasswordController extends Controller
{
    /**
     * Returns a random generated password response
     *
     * @param  PasswordGeneratorInterface $generator
     * @return HtmlStream|null
     */
    public function index(PasswordGeneratorInterface $generator):? HtmlStream
    {
        return output()->html($generator->create(14));
    }
}
