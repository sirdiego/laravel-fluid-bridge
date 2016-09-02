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
        $cache = new SimpleFileCache(config('fluid.cache.path', base_path('bootstrap/cache')));
        $resolver = new ViewHelperResolver();
        $context = new RenderingContext(new TemplateView());
        $context->setCache($cache);
        $context->setViewHelperResolver($resolver);
        $this->app->extend('view.engine.resolver', function (EngineResolver $resolver) use ($context) {
            $resolver->register('fluid', function () use ($context) {
                return new FluidEngine($context);
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


}