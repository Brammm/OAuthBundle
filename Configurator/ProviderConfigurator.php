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
    private $loginResponsePath;
    /** @var array */
    private $config;

    public function __construct(RouterInterface $router, $loginResponsePath, array $config)
    {
        $this->router            = $router;
        $this->loginResponsePath = $loginResponsePath;
        $this->config            = $config;
    }

    public function configure(ProviderBase $provider)
    {
        if (!isset($this->config[$provider->getAlias()])) {
            throw new InvalidConfigurationException;
        }

        $provider->setRouter($this->router);
        $provider->setLoginResponsePath($this->loginResponsePath);
        $provider->setConfig($this->config[$provider->getAlias()]);
    }
} 