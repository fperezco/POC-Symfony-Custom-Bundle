<?php


namespace Paco\CustomPacoBundle\Tests\Controller;

use Paco\CustomPacoBundle\PacoNumberGeneratorBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\Routing\RouteCollectionBuilder;

class NumberGeneratorApiControllerTest extends TestCase
{

    public function testIndex()
    {
        //instantiate the fake app:
        $kernel = new NumberGeneratorApiControllerKernel();
        $client = new KernelBrowser($kernel);
        $client->request('GET', '/api');
        //var_dump($client->getResponse()->getContent());
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

}


/**
 * Just a class to emulate testing kernel functional test
 * Class NumberGeneratorApiControllerKernel
 * @package Paco\CustomPacoBundle\Tests\Controller
 */
class NumberGeneratorApiControllerKernel extends Kernel
{
    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function registerBundles()
    {
        return [
            new FrameworkBundle(),//just we will need it here
            new PacoNumberGeneratorBundle(),
        ];
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        //$routes->import(__DIR__.'/../../src/Resources/config/routes.yml')->prefix('/api');
        //$routes->import(__DIR__.'/../../src/Resources/config/routes.xml')->prefix('/api');
        //$routes->import(__DIR__.'/../../src/Resources/config/routes.yml', '/api');
        $routes->import(__DIR__.'/../../src/Resources/config/routes.xml', '/api');
    }


    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        //configuration needed by default by FrameworkExtension
        $c->loadFromExtension('framework', [
            'secret' => 'F00',
            'router' => ['utf8' => true],
        ]);
    }

    public function getCacheDir()
    {
        return __DIR__.'/../cache/'.spl_object_hash($this);
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        // TODO: Implement registerContainerConfiguration() method.
    }
}