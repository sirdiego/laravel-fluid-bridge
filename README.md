# Installation
```bash
composer require diego/laravel-fluid-bridge dev-master
```
In the `config/app.php` add `FluidServiceProvider` to the `providers` section.
```php
'providers' => [
	Diego\Fluid\FluidServiceProvider::class,
],
```

# Usage
## The Laravel Way
By default you can now resolve ".html" templates with the normal `view('name')` call. These files will be rendered by TYPO3.Fluid.
## The Extbase Way
Further more you can exten the `Diego\Fluid\Controller\AbstractFluidController` instead of the BaseController and use the view like in Extbase:
 
```php
class Page extends AbstractFluidController
{
    public function welcome()
    {
        $this->view->assign('name', 'John');
    }
}
```

This will resolve the template name to `resources/views/Templates/Page/Welcome.html` automatically and will render the template after the action is finished.