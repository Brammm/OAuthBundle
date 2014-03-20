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
        $oauthService = $container->getDefinition('brammm_oauth.oauth');
        $providerIds  = $container->findTaggedServiceIds('brammm_oauth.provider');

        foreach ($providerIds as $serviceId => $tags) {
            foreach ($tags as $tagAttributes) {
                // Add the provider to the oauth service
                $oauthService->addMethodCall('addProvider', [
                    $tagAttributes['provider'],
                    new Reference($serviceId),
                ]);
            }
        }
    }


}
