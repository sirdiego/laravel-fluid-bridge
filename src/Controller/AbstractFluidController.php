<?php
namespace Diego\Fluid\Controller;

use Illuminate\Routing\Controller;
use TYPO3Fluid\Fluid\View\TemplateView;
use TYPO3Fluid\Fluid\View\ViewInterface;

/**
 * Class AbstractFluidController.
 */
abstract class AbstractFluidController extends Controller
{
    /**
     * @var ViewInterface
     */
    protected $view;

    /**
     * Execute an action on the controller.
     *
     * @param  string $method
     * @param  array $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        /** @var TemplateView $view */
        $view = resolve(TemplateView::class);
        $context = $view->getRenderingContext();
        $context->setControllerAction($method);
        $context->setControllerName((new \ReflectionClass($this))->getShortName());
        $view->setRenderingContext($context);
        $this->view = $view;
        $result = parent::callAction($method, $parameters);
        if ($result === null) {
            $result = $this->view->render();
        }
        return $result;
    }
}
