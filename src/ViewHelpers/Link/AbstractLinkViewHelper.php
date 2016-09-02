<?php
namespace Diego\Fluid\ViewHelpers\Link;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * Class AbstractLinkViewHelper.
 */
abstract class AbstractLinkViewHelper extends AbstractTagBasedViewHelper
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
        $this->registerArgument('parameters', 'array', 'The parameters to add', false, []);
    }

    /**
     * @return string
     */
    public function render()
    {
        if ($this->renderChildrenClosure) {
            $content = call_user_func($this->renderChildrenClosure);
        } else {
            $content = $this->renderChildren();
        }
        $this->tag->setContent($content);
        return parent::render();
    }
}