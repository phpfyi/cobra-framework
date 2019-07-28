<?php

namespace Cobra\Cms;

use Cobra\Interfaces\Cms\CmsMessagesInterface;
use Cobra\Interfaces\Http\Message\RequestInterface;
use Cobra\Interfaces\Http\Message\ResponseInterface;
use Cobra\Interfaces\View\ViewObject;
use Cobra\Http\Traits\UsesRequest;
use Cobra\Http\Traits\UsesResponse;
use Cobra\View\Traits\RendersTemplate;

/**
 * CMS Messages
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
class CmsMessages implements CmsMessagesInterface, ViewObject
{
    use UsesRequest, UsesResponse, RendersTemplate;

    /**
     * Template file path
     *
     * @var string
     */
    public $template = 'templates.Cms.CmsMessages';

    /**
     * Array of messages
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Sets the required properties.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Setup method to load the current session messages.
     *
     * @return CmsMessagesInterface
     */
    public function setup(): CmsMessagesInterface
    {
        $this->setMessages(
            (array) $this->response->getSession()->get('messages')
        );
        $this->response->getSession()->remove('messages');

        return $this;
    }

    /**
     * Sets an array of messages
     *
     * @param  array $messages
     * @return CmsMessagesInterface
     */
    public function setMessages(array $messages): CmsMessagesInterface
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * Returns all messages
     *
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }
    
    /**
     * Sets a session message
     *
     * @param  string $content
     * @param  string $class
     * @return CmsMessagesInterface
     */
    public function setSessionMessage(string $content, string $class = 'good'): CmsMessagesInterface
    {
        $this->response->getSession()->set(
            'messages',
            array_merge(
                (array) $this->response->getSession()->get('messages'),
                [
                    (object) [
                        'content' => $content,
                        'class' => $class
                    ]
                ]
            )
        );

        return $this;
    }

    /**
     * Returns an array of view data
     *
     * @return array
     */
    public function getViewData(): array
    {
        return [
            'messages' => $this->getMessages()
        ];
    }
}
