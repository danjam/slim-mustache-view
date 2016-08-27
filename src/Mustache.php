<?php

namespace Slim\Views;

use Psr\Http\Message\ResponseInterface;

/**
 * Simple view renderer to use Mustache.php templates in Slim 3 views
 *
 * @package Slim\Views
 * @author Danny James <hello@dannyjames.net>
 * @license https://github.com/danjam/slim-mustache-view/blob/master/LICENSE MIT
 * @link https://github.com/slimphp/Slim
 * @link https://github.com/bobthecow/mustache.php
 */
class Mustache
{
    /**
     * Holds the Mustache_Engine instance
     * @var \Mustache_Engine
     */
    protected $mustache;

    /**
     * Constructor
     *
     * @param array $options An array of Mustache.php options
     */
    public function __construct(array $options = [])
    {
        $this->mustache = new \Mustache_Engine($options);
    }

    /**
     * Fetch a rendered template
     *
     * @param mixed $template The mustache template string/path
     * @param array|object $data The template data
     * @return string The rendered template
     */
    public function fetch($template, $data = [])
    {
        return $this->mustache->render($template, $data);
    }

    /**
     * Render a template to a PSR-7 response object
     *
     * @param ResponseInterface $response The PSR-7 response
     * @param mixed $template The mustache template string/path
     * @param array|object $data The template data
     * @return ResponseInterface A PSR-7 response populated with the rendered mustache template
     */
    public function render(ResponseInterface $response, $template, $data = [])
    {
        $response->getBody()->write($this->fetch($template, $data));
        return $response;
    }

    /**
     * Fetch the raw template
     *
     * @param mixed $template The mustache template string/path
     * @return string The raw template contents
     * @since 1.1.0
     */
    public function getRawTemplate($template)
    {
        return $this->mustache->getLoader()->load($template);
    }
}
