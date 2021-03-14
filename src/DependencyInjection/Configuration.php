<?php


namespace Paco\CustomPacoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('custom_paco_bundle');
        $rootNode = $treeBuilder->getRootNode();
         $rootNode
             ->children()
             //->booleanNode('unicorns_are_real')->defaultTrue()->end()
             ->integerNode('basenumber')->defaultValue(3)->end()
             ->integerNode('topnumber')->defaultValue(3)->end()
             ->scalarNode('meeting_message_provider')->defaultNull()->end()
             ->end()
         ;
         return $treeBuilder;
    }
}