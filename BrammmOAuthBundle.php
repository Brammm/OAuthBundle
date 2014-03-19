<?php

namespace Brammm\OAuthBundle;

use Brammm\OAuthBundle\DependencyInjection\BrammmOAuthExtension;
use Brammm\OAuthBundle\DependencyInjection\Compiler\ProvidersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BrammmOAuthBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ProvidersPass());
    }

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            return new BrammmOAuthExtension();
        }

        return $this->extension;
    }
}
