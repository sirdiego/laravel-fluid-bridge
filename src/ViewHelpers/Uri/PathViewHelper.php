<?php
namespace Diego\Fluid\ViewHelpers\Uri;

/**
 * Class PathViewHelper.
 */
class PathViewHelper extends AbstractUriViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'a';

    /**
     *
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('path', 'string', 'The path of the URL');
        $this->registerArgument('secure', 'boolean', 'Use SSL', false, false);
    }

    /**
     * @return string
     */
    public function render()
    {
        $url = url($this->arguments['path'], $this->arguments['parameters'], $this->arguments['secure']);
        return $url;
    }
}