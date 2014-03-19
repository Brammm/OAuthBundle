<?php

namespace Brammm\OAuthBundle\Provider;

interface ProviderInterface
{
    /**
     * Gets the redirect URL
     *
     * @return string
     */
    public function getOAuthUrl();
} 