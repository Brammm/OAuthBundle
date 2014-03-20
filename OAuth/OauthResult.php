<?php

namespace Brammm\OAuthBundle\OAuth;

class OauthResult 
{
    /** @var string */
    private $accessToken;
    /** @var \DateTime */
    private $expiresAt;

    function __construct($accessToken, \DateTime $expiresAt)
    {
        $this->accessToken = $accessToken;
        $this->expiresAt   = $expiresAt;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
w
} 