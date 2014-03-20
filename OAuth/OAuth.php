<?php

namespace Brammm\OAuthBundle\OAuth;

use Brammm\OAuthBundle\Exception\ProviderNotFoundException;
use Brammm\OAuthBundle\Provider\ProviderBase;

class OAuth
{
    /** @var ProviderBase[] */
    protected $providers;

    /**
     * @param string $provider
     *
     * @return ProviderBase
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
     * @param ProviderBase $provider
     */
    public function addProvider($key, ProviderBase $provider)
    {
        $this->providers[$key] = $provider;
    }
} 