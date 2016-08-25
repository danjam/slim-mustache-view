# slim-mustache-view

[![Build Status](https://travis-ci.org/danjam/slim-mustache-view.svg?branch=master)](https://travis-ci.org/danjam/slim-mustache-view)

Simple [Slim 3](https://github.com/slimphp/Slim) view renderer for [Mustache.php](https://github.com/bobthecow/mustache.php)

## Install

Via [Composer](https://getcomposer.org/)

```bash
$ composer require danjam/slim-mustache-view
```

## Usage

The constructor takes an optional array of Mustache.php options. See the [Mustache.php documentation](https://github.com/bobthecow/mustache.php/wiki#constructor-options) for details.

```php
// create Slim 3 app
$app = new \Slim\App();

// get the container
$container = $app->getContainer();

// register Mustache view
$container['view'] = function ($container) {
    // constructor takes an optional array of Mustache.php options
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

## Testing

```bash
phpunit
```

## Credits

- [Danny James](https://github.com/danjam)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

