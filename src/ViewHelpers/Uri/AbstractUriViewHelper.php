<?php
namespace Diego\Fluid\ViewHelpers\Uri;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class AbstractUriViewHelper.
 */
abstract class AbstractUriViewHelper extends AbstractViewHelper
{
    /**
     *
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('parameters', 'array', 'The parameters to add', false, []);
    }
}