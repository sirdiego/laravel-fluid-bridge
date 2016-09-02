<?php
namespace Diego\Fluid\ViewHelpers\Uri;

/**
 * Class ActionViewHelper.
 */
class ActionViewHelper extends AbstractUriViewHelper
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
        return $url;
    }
}