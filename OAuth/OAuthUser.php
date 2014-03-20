<?php

namespace Brammm\OAuthBundle\OAuth;

class OAuthUser 
{
    /** @var string */
    private $id;
    /** @var string */
    private $email;
    /** @var string */
    private $firstName;
    /** @var string */
    private $lastName;

    public function __construct($id, $email, $firstName = null, $lastName = null)
    {
        $this->id        = $id;
        $this->email     = $email;
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }


} 