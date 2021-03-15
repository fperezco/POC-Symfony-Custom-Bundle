<?php


namespace Paco\CustomPacoBundle\Tests;



use Paco\CustomPacoBundle\Interfaces\MeetingMessageProviderInterface;
use Paco\CustomPacoBundle\PacoNumberGenerator;
use Paco\CustomPacoBundle\PacoNumberGeneratorBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class FunctionalTest extends TestCase
{
    public function testServiceWiring()
    {
        //this 3 lines to boot a real symfony app
        $kernel = new RealSymfonyAPPTestingKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        //we test that there is a right wiring
        $ipsum = $container->get('custom_paco_bundle.paco_number_generator');
        $this->assertInstanceOf(PacoNumberGenerator::class, $ipsum);
        $this->assertIsString( $ipsum->getNumber());
    }

    public function testServiceWiringWithConfiguration()
    {
        //init app with custom configuration
        $kernel = new RealSymfonyAPPTestingKernel([
                    'meeting_message_provider' => 'example_meeting_provider'
                    ]);
        $kernel->boot();
        $container = $kernel->getContainer();

        //test that the service injected is the correct service
        $ipsum = $container->get('custom_paco_bundle.paco_number_generator');
        $this->assertStringContainsString('fake', $ipsum->getNumber());
    }


}

class RealSymfonyAPPTestingKernel extends Kernel
{
    private $bundleConfig;

    /*
        When you boot a kernel, it creates a tests/cache directory
        that includes the cached container. The problem is that it's
        using the same cache directory for both tests. Once the cache
        directory is populated the first time, all future tests re-use
        the same container from the first test, instead of building their
        own.

     */
    public function getCacheDir()
    {
        return __DIR__.'/cache/'.spl_object_hash($this);
    }

    public function __construct(array $bundleConfig = [])
    {
        $this->bundleConfig = $bundleConfig;
        parent::__construct('test', true);
    }

    //we use to enable our bundle
    public function registerBundles()
    {
        return [
            new PacoNumberGeneratorBundle(),
        ];
    }

    //this is the method that's responsible for parsing all the YAML files in the config/packages directory and the services.yaml file.
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        //Instead of parsing YAML files, we can instead put all that logic into PHP with $loader->load()
        //passing it a callback function with a ContainerBuilder argument.
        // Inside of here, we can start registering services and passing bundle extension configuration
        $loader->load(function(ContainerBuilder $container) {
            $container->register('example_meeting_provider', ExampleOfMessageProvider::class);
            $container->loadFromExtension('paco_number_generator', $this->bundleConfig);
        });
    }
}


class ExampleOfMessageProvider implements MeetingMessageProviderInterface
{
    public function getWordList(): array
    {
        return ['fake1test', 'fake2test'];
    }
}