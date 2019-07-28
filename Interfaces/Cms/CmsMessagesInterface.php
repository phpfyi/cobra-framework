<?php

namespace Cobra\Interfaces\Cms;

use Cobra\Model\Model;

/**
 * CMS Messages Interface
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
interface CmsMessagesInterface
{
    /**
     * Sets an array of messages
     *
     * @param  array $messages
     * @return CmsMessagesInterface
     */
    public function setMessages(array $messages): CmsMessagesInterface;

    /**
     * Returns all messages
     *
     * @return array
     */
    public function getMessages(): array;
    
    /**
     * Sets a session message
     *
     * @param  string $content
     * @param  string $class
     * @return CmsMessagesInterface
     */
    public function setSessionMessage(string $content, string $class = 'good'): CmsMessagesInterface;
}
