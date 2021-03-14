<?php


namespace Paco\CustomPacoBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class PacoNumberGeneratorExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        //var_dump($configs);die;
        // TODO: Implement load() method.
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        //$loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        //$loader->load('services.xml');

        //we pass the argument from the config/packages/paco_number_generator.yml to the class
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('custom_paco_bundle.paco_number_generator');
        //$definition->setArgument(0, $config['basenumber']);
        //$definition->setArgument(1, $config['topnumber']);

        if (null !== $config['meeting_message_provider']) {
            //$definition->setArgument(0, $config['meeting_message_provider']);
            //$definition->setArgument(0, new Reference($config['meeting_message_provider']));
            $container->setAlias('custom_paco_bundle.meeting_message_provider', $config['meeting_message_provider']);
        }

        $definition->setArgument(1, $config['basenumber']);
        $definition->setArgument(2, $config['topnumber']);
    }
}