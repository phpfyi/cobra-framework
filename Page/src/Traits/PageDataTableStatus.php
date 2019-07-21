<?php

namespace Cobra\Page\Traits;

use Cobra\Model\Model;

/**
 * Page Data Table Status trait
 *
 * @category  Page
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
trait PageDataTableStatus
{
    /**
     * Returns the page status
     *
     * @return integer
     */
    public function tableStatus(): string
    {
        return sprintf(
            '<div class="table-status table-status-%s">%s</div>',
            $this->status,
            config('status.options')[$this->status]
        );
    }
}
