<?php

namespace Brammm\OAuthBundle\OAuth;

use Brammm\OAuthBundle\Exception\ProviderNotFoundException;
use Brammm\OAuthBundle\Provider\ProviderInterface;

class OAuth
{
    /** @var ProviderInterface[] */
    protected $providers;

    /**
     * @param string $provider
     *
     * @return ProviderInterface
     * @throws ProviderNotFoundException
     */
    public function getProvider($provider)
    {
        if (!isset($this->providers[$provider])) {
            throw new ProviderNotFoundException;
        }

        return $this->providers[$provider];
    }

    /**
     * @param string            $key
     * @param ProviderInterface $provider
     */
    public function addProvider($key, ProviderInterface $provider)
    {
        $this->providers[$key] = $provider;
    }
} 