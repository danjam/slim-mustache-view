<?php

namespace Slim\Tests\Views;

use Slim\Views\Mustache;

require dirname(__DIR__) . '/vendor/autoload.php';

class MustacheTest extends \PHPUnit_Framework_TestCase
{
    /** @var Mustache */
    protected $view;
    protected $templateData = "Test data, {{ test }}\n";

    public function setUp()
    {
        $this->view = new Mustache([]);
    }

    public function testFetch()
    {
        $output = $this->view->fetch($this->templateData, [
            'test' => 'TEST'
        ]);

        $this->assertEquals("Test data, TEST\n", $output);
    }

    public function testRender()
    {
        $mockBody = $this->getMockBuilder('Psr\Http\Message\StreamInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $mockResponse = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $mockBody->expects($this->once())
            ->method('write')
            ->with("Test data, TEST\n")
            ->willReturn(17);

        $mockResponse->expects($this->once())
            ->method('getBody')
            ->willReturn($mockBody);

        $response = $this->view->render($mockResponse, $this->templateData, [
            'test' => 'TEST'
        ]);

        $this->assertInstanceOf('Psr\Http\Message\ResponseInterface', $response);
    }
    
    public function testGetRawTemplate()
    {
        $template = $this->view->getRawTemplate($this->templateData);
        $this->assertSame($this->templateData, $template);
    }
}
