<?php


namespace Paco\CustomPacoBundle\Tests;



use Paco\CustomPacoBundle\PacoNumberGenerator;
use Paco\CustomPacoBundle\PacoNumberGeneratorBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class FunctionalTest extends TestCase
{
    public function testServiceWiring()
    {
        //this 3 lines to boot a real symfony app
        $kernel = new RealSymfonyAPPTestingKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();

        //we test that there is a right wiring
        $ipsum = $container->get('custom_paco_bundle.paco_number_generator');
        $this->assertInstanceOf(PacoNumberGenerator::class, $ipsum);
        $this->assertInternalType('string', $ipsum->getNumber());
    }
}

class RealSymfonyAPPTestingKernel extends Kernel
{
    //we use to enable our bundle
    public function registerBundles()
    {
        return [
            new PacoNumberGeneratorBundle(),
        ];
    }
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }
}