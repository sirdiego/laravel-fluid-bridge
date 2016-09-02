<?php
namespace Diego\Fluid;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use TYPO3Fluid\Fluid\Core\Cache\SimpleFileCache;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContext;
use TYPO3Fluid\Fluid\View\TemplateView;

/**
 * Class FluidServiceProvider.
 */
class FluidServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function register()
    {
        $this->registerEngineResolver();
        $this->registerViewFinder();
        $this->registerFactory();
        $this->registerView();
    }

    /**
     *
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/fluid.php';
        $this->mergeConfigFrom($configPath, 'fluid');
    }

    private function registerEngineResolver()
    {
        $this->app->bind(RenderingContext::class, function () {
            $cache = new SimpleFileCache(config('fluid.cache.path', base_path('bootstrap/cache')));
            $resolver = new ViewHelperResolver();
            $context = new RenderingContext(new TemplateView());
            $context->setCache($cache);
            $context->setViewHelperResolver($resolver);
            $paths = $context->getTemplatePaths();
            $paths->setTemplateRootPaths(config('fluid.rootPaths.template', [
                base_path('resources/views/Templates/')
            ]));
            $paths->setLayoutRootPaths(config('fluid.rootPaths.layout', [
                base_path('resources/views/Layouts/')
            ]));
            $paths->setPartialRootPaths(config('fluid.rootPaths.partial', [
                base_path('resources/views/partials/')
            ]));

            return $context;
        });

        $this->app->extend('view.engine.resolver', function (EngineResolver $resolver) {
            $resolver->register('fluid', function () {
                return new FluidEngine(resolve(RenderingContext::class));
            });

            return $resolver;
        });
    }

    private function registerViewFinder()
    {
        $this->app->extend('view.finder', function (FileViewFinder $finder) {
            $finder->addExtension(config('fluid.extension', 'html'));
            return $finder;
        });
    }

    private function registerFactory()
    {
        $this->app->extend('view', function (Factory $factory) {
            $factory->addExtension(config('fluid.extension', 'html'), 'fluid');
            return $factory;
        });
    }

    private function registerView()
    {
        $this->app->bind(TemplateView::class, function () {
            $view = new TemplateView();
            $view->setRenderingContext(resolve(RenderingContext::class));
            return $view;
        });
    }
}
