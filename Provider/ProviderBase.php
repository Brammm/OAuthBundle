<?php

namespace Brammm\OAuthBundle\Provider;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

abstract class ProviderBase
{
    /** @var string */
    protected $loginResponsePath;
    /** @var array */
    protected $config;
    /** @var RouterInterface */
    protected $router;

    ########################
    ## Abstract functions ##
    ########################

    /**
     * Gets the redirect URL
     * Allows you to overwrite the default parameters
     *
     * @param array $parameters
     *
     * @return string
     */
    abstract public function getOAuthUrl(array $parameters = null);

    /**
     * Gets an alias for the provider.
     * Must equal the alias provided in the configuration
     *
     * @return string
     */
    abstract public function getAlias();

    /**
     * Handles the login response
     *
     * @param Request $request
     *
     * @return mixed
     */
    abstract public function handleLoginResponse(Request $request);

    ######################
    ## Helper functions ##
    #####################

    /**
     * Generates a unique string
     *
     * @return string
     */
    protected function getState()
    {
        return uniqid();
    }

    /**
     * Generates the redirect uri that's configured
     *
     * @return string
     */
    protected function getRedirectUri()
    {
        return $this->router->generate($this->loginResponsePath, ['provider' => $this->getAlias()], RouterInterface::ABSOLUTE_URL);
    }

    // TODO: move this to own class/use existing lib?
    /**
     * Calls an url and returns it's response
     *
     * @param string $url
     *
     * @return string
     */
    protected function callUrl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    ################
    ## DI Setters ##
    ################

    /**
     * @param $loginResponsePath
     */
    public function setLoginResponsePath($loginResponsePath)
    {
        $this->loginResponsePath = $loginResponsePath;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param RouterInterface $router
     */
    public function setRouter(RouterInterface $router)
    {
        $this->router = $router;
    }

} 