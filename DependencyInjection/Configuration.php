<?php

namespace Brammm\OAuthBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('brammm_oauth');

        $rootNode
            ->children()
                ->arrayNode('providers')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('app_id')->end()
                            ->scalarNode('app_secret')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
} 