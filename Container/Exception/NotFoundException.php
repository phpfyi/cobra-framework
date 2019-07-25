<?php

namespace Cobra\Container\Exception;

use Psr\Container\NotFoundExceptionInterface;

/**
 * Not Found Exception
 *
 * @category  Container
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class NotFoundException extends \Exception implements NotFoundExceptionInterface
{

}
