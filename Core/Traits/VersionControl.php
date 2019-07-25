<?php

namespace Cobra\Core\Traits;

use DateTime;
use DateTimeZone;

/**
 * Version Control Trait
 *
 * @category  Core
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait VersionControl
{
    /**
     * Returns the application source control version information.
     *
     * @return string
     */
    public static function getVersionNumber(int $major = 0, int $minor = 0, int $patch = 0): string
    {
        $commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

        $commitDate = new DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new DateTimeZone(config('i18n.timezone')));

        return sprintf(
            'Version %s.%s.%s - sha.%s<br>%s',
            $major,
            $minor,
            $patch,
            $commitHash,
            $commitDate->format('H:i:s d-m-Y')
        );
    }
}
