# slim-mustache-view

[![Build Status](https://travis-ci.org/danjam/slim-mustache-view.svg?branch=master)](https://travis-ci.org/danjam/slim-mustache-view) [![Latest Stable Version](https://poser.pugx.org/danjam/slim-mustache-view/v/stable)](https://packagist.org/packages/danjam/slim-mustache-view) [![Coverage Status](https://coveralls.io/repos/github/danjam/slim-mustache-view/badge.svg?branch=master)](https://coveralls.io/github/danjam/slim-mustache-view?branch=master)

Simple [Slim 3 framework](https://github.com/slimphp/Slim) view renderer for [mustache](http://mustache.github.io/mustache.5.html) templates using [Mustache.php](https://github.com/bobthecow/mustache.php)

## Install

Via [Composer](https://getcomposer.org/)

```bash
$ composer require danjam/slim-mustache-view
```

## Usage

```php
// create Slim 3 app
$app = new \Slim\App();

// get the container
$container = $app->getContainer();

// register Mustache view
$container['view'] = function ($container) {
    $view = new \Slim\Views\Mustache();
    
    return $view;
};

// define the route
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->view->render($response, 'Hello, {{name}}', [
        'name' => $args['name']
    ]);
});

// run the app
$app->run();
```

The constructor takes an optional array of Mustache.php options. See the [Mustache.php documentation](https://github.com/bobthecow/mustache.php/wiki#constructor-options) for details.

```php
// register Mustache view
$container['view'] = function () {
    $view = new \Slim\Views\Mustache([
        'cache' => './cache/mustache',
        'loader' => new Mustache_Loader_FilesystemLoader('./views'),
        'partials_loader' => new Mustache_Loader_FilesystemLoader('./views/partials')
    ]);

    return $view;
};
```

You can also capture raw template contents if needed. This can be useful for rendering inline templates, for example when also using [mustache.js](https://github.com/janl/mustache.js/)

```php
$this->view->getRawTemplate('some-template.html');
```

## Testing

```bash
phpunit
```

## Credits

- [Danny James](https://github.com/danjam)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

