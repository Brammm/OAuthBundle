<?php

namespace Brammm\OAuthBundle\Provider;

class FacebookProvider implements ProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function getOAuthUrl()
    {
        $url = 'https://www.facebook.com/dialog/oauth';


        echo $url; exit;
        return $url;
    }
}