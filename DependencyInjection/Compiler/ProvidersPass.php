<?php

namespace Brammm\OAuthBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ProvidersPass implements CompilerPassInterface
{

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $taggedServiceIds         = $container->findTaggedServiceIds('brammm_oauth.provider');
        $objectRendererDefinition = $container->getDefinition('brammm_oauth.oauth');

        foreach ($taggedServiceIds as $serviceId => $tags) {
            foreach ($tags as $tagAttributes) {
                $objectRendererDefinition->addMethodCall('addProvider', [
                    $tagAttributes['provider'],
                    new Reference($serviceId),
                ]);
            }
        }
    }


}
