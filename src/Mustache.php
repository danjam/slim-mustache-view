<?php

namespace Slim\Views;

use Psr\Http\Message\ResponseInterface;

/**
 * Class Mustache
 * @package Slim\Views
 */
class Mustache
{
    /**
     * @var \Mustache_Engine
     */
    protected $mustache;

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->mustache = new \Mustache_Engine($options);
    }

    /**
     * @param $template
     * @param array $data
     * @return string
     */
    public function fetch($template, $data = [])
    {
        return $this->mustache->render($template, $data);
    }

    /**
     * @param ResponseInterface $response
     * @param mixed $template
     * @param array $data
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, $template, array $data = [])
    {
        $response->getBody()->write($this->fetch($template, $data));
        return $response;
    }
}
