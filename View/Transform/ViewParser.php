<?php

namespace Cobra\View\Transform;

use Cobra\Interfaces\View\Transform\ViewParserInterface;

/**
 * View Parser
 *
 * @category  View
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class ViewParser extends ViewTransformer implements ViewParserInterface
{
    /**
     * Regex to match framework tags $( )$
     *
     * @var string
     */
    protected $frameworkTagsCapture = '#(\$\()%s(\)\$)#';

    /**
     * Regex to place content withing framework tags
     *
     * @var string
     */
    protected $phpLanguageCapture = '$(%s)$';

    /**
     * Regex to place content withing PHP tags
     *
     * @var string
     */
    protected $phpTagsCapture = '<?php %s ?>';

    /**
     * Array of template expressions
     *
     * @var array
     */
    protected $expressions = [];

    /**
     * Sets the input code
     *
     * @param string $input
     */
    public function __construct(string $input)
    {
        parent::__construct($input);
        
        $this->expressions = static::config('expressions');
    }

    /**
     * Returns the parsed template content.
     *
     * @return string
     */
    public function getOutput(): string
    {
        array_map(
            function ($find, $replace) {
                $this->input = preg_replace(
                    sprintf($this->frameworkTagsCapture, $find),
                    sprintf($this->phpLanguageCapture, $replace),
                    $this->input
                );
            },
            array_keys($this->expressions),
            $this->expressions
        );
        $this->input = preg_replace(
            sprintf($this->frameworkTagsCapture, '(.*?)'),
            sprintf($this->phpTagsCapture, '$2'),
            $this->input
        );
        return (string) $this->input;
    }
}
