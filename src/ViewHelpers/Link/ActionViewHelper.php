<?php
namespace Diego\Fluid\ViewHelpers\Link;

/**
 * Class ActionViewHelper.
 */
class ActionViewHelper extends AbstractLinkViewHelper
{
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('action', 'string', 'The name of the Controller/Action', true);
        $this->registerArgument('absolute', 'boolean', 'Absolute URL', false, false);
    }

    public function render()
    {
        $url = action($this->arguments['action'], $this->arguments['parameters'], $this->arguments['absolute']);
        $this->tag->addAttribute('href', $url);
        return parent::render();
    }
}
