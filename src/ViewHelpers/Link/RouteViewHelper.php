<?php
namespace Diego\Fluid\ViewHelpers\Link;

/**
 * Class RouteViewHelper.
 */
class RouteViewHelper extends AbstractLinkViewHelper
{
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('route', 'string', 'The name of the route', true);
        $this->registerArgument('absolute', 'boolean', 'Absolute URL', false, false);
    }

    public function render()
    {
        $url = route($this->arguments['route'], $this->arguments['parameters'], $this->arguments['absolute']);
        $this->tag->addAttribute('href', $url);
        return parent::render();
    }
}