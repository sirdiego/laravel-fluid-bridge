<?php
namespace Diego\Fluid\ViewHelpers\Uri;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class AssetViewHelper.
 */
class AssetViewHelper extends AbstractViewHelper
{
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('path', 'string', 'The relative path to the asset', true);
        $this->registerArgument('secure', 'string', 'Use SSL', false, false);
    }

    public function render()
    {
        $url = asset($this->arguments['path'], $this->arguments['secure']);
        return $url;
    }
}