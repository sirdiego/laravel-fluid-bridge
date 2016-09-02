<?php
namespace Diego\Fluid\ViewHelpers\Link;

/**
 * Class PathViewHelper.
 */
class PathViewHelper extends AbstractLinkViewHelper
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
        $this->tag->addAttribute('href', $url);
        return parent::render();
    }
}
