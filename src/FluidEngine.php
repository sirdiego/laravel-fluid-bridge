<?php
namespace Diego\Fluid;

use Illuminate\View\Engines\EngineInterface;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContext;
use TYPO3Fluid\Fluid\View\TemplateView;

/**
 * Class FluidEngine.
 */
class FluidEngine implements EngineInterface
{
    /**
     * @var RenderingContext
     */
    protected $context;

    /**
     * FluidEngine constructor.
     * @param RenderingContext $context
     */
    public function __construct(RenderingContext $context)
    {
        $this->context = $context;
    }

    /**
     * @param string $path
     * @param array $data
     * @return string
     */
    public function get($path, array $data = [])
    {
        $view = new TemplateView();
        $view->setRenderingContext($this->context);
        $paths = $view->getTemplatePaths();
        $paths->setTemplateRootPaths(config('fluid.rootPaths.template', [
            base_path('resources/views/Templates/')
        ]));
        $paths->setLayoutRootPaths(config('fluid.rootPaths.layout', [
            base_path('resources/views/Layouts/')
        ]));
        $paths->setPartialRootPaths(config('fluid.rootPaths.partial', [
            base_path('resources/views/partials/')
        ]));
        $paths->setTemplatePathAndFilename($path);

        $view->assignMultiple($data);

        return $view->render();
    }

}