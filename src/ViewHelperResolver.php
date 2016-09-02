<?php
namespace Diego\Fluid;

use TYPO3Fluid\Fluid\Core\Parser\Exception;

/**
 * Class ViewHelperResolver.
 */
class ViewHelperResolver extends \TYPO3Fluid\Fluid\Core\ViewHelper\ViewHelperResolver
{
    /**
     * ViewHelperResolver constructor.
     */
    public function __construct()
    {
        $this->addNamespace('_f', 'Diego\\Fluid\\ViewHelpers');
    }

    /**
     * @param string $namespaceIdentifier
     * @param string $methodIdentifier
     * @return NULL|string
     */
    public function resolveViewHelperClassName($namespaceIdentifier, $methodIdentifier)
    {
        try {
            return parent::resolveViewHelperClassName($namespaceIdentifier, $methodIdentifier);
        } catch (Exception $exception) {
            if ($namespaceIdentifier !== 'f') {
                throw $exception;
            }

            return parent::resolveViewHelperClassName('_f', $methodIdentifier);
        }
    }
}