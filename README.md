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
