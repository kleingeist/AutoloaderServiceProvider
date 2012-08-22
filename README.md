AutoloaderServiceProvider
=========================


Simple transisitonal Service Provider mapping the deprecated Silex autoloader to Composer.


Silex replaced its own autoloader in favour of the one configured with composer.
Unfortunately this will break many ServiceProviders, that are not under active development and makes it impossible to add namespaces dynamically.
For example https://github.com/mjakubowski/nutwerk-orm-extension has to register namespaces dependent on the config.

This Service Provider can work as an interim solution until more of the Third Party Providers are updated and can provide dynamic extension of namespaces.



Usage
-----

Add ae35/autoloader-service-provider as a requirement to your composer.json and register the Service Provider in Silex

```php
<?php

$loader = require_once __DIR__ . '/../vendor/autoload.php';

$app->register(new ae35\Provider\ComposerAutoloaderServiceProvider($loader));
```
