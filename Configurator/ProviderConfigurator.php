<?php

namespace Brammm\OAuthBundle\Configurator;

use Brammm\OAuthBundle\Provider\ProviderBase;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Routing\RouterInterface;

class ProviderConfigurator
{
    /** @var RouterInterface */
    private $router;
    /** @var string */
    private $redirectPath;
    /** @var array */
    private $config;

    public function __construct(RouterInterface $router, $redirectPath, array $config)
    {
        $this->router            = $router;
        $this->redirectPath      = $redirectPath;
        $this->config            = $config;
    }

    public function configure(ProviderBase $provider)
    {
        if (!isset($this->config[$provider->getAlias()])) {
            throw new InvalidConfigurationException;
        }

        $provider->setRouter($this->router);
        $provider->setRedirectPath($this->redirectPath);
        $provider->setConfig($this->config[$provider->getAlias()]);
    }
} 