<?php

namespace Brammm\OAuthBundle\Provider;

use Brammm\OAuthBundle\Exception\LoginInterruptedException;
use Brammm\OAuthBundle\Exception\OAuthException;
use Brammm\OAuthBundle\OAuth\OAuthResult;
use Brammm\OAuthBundle\OAuth\OAuthUser;
use Symfony\Component\HttpFoundation\Request;

class FacebookProvider extends ProviderBase
{

    /**
     * {@inheritDoc}
     */
    public function getAlias()
    {
        return 'facebook';
    }

    /**
     * {@inheritDoc}
     */
    public function getOAuthUrl(array $parameters = [])
    {
        $parameters += [
            'client_id'    => $this->config['client_id'],
            'redirect_uri' => $this->getRedirectUri(),
            'state'        => $this->getState(),
            'scope'        => $this->config['scope'],
            'display'      => 'page',
        ];

        return 'https://www.facebook.com/dialog/oauth?' . http_build_query($parameters);
    }

    /**
     * {@inheritDoc}
     */
    public function handleLoginResponse(Request $request)
    {
        if ($request->query->has('error')) {
            $exception = new LoginInterruptedException($request->query->get('error_description'));
            $exception
                ->setReason($request->query->get('error_reason'))
                ->setShortCode($request->query->get('error'));
            throw $exception;
        }

        if (!$request->query->has('code')) {
            throw new \InvalidArgumentException("'code' is missing from the query string");
        }

        $parameters = [
            'client_id'     => $this->config['client_id'],
            'redirect_uri'  => $this->getRedirectUri(),
            'client_secret' => $this->config['client_secret'],
            'code'          => $request->query->get('code'),
        ];
        $url = 'https://graph.facebook.com/oauth/access_token?' . http_build_query($parameters);

        $response = $this->callUrl($url);

        $json = json_decode($response);
        if (JSON_ERROR_NONE === json_last_error()) {
            if (isset($json->error)) {
                throw new OAuthException($json->error->message, $json->error->code);
            }
            throw new \LogicException('Unexpected JSON result');
        }

        parse_str($response, $responseParameters);

        $expiresAt = new \DateTime();
        $expiresAt->modify(sprintf('+%d seconds', $responseParameters['expires']));

        return new OAuthResult($responseParameters['access_token'], $expiresAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getOAuthUser(OauthResult $oauthResult)
    {
        $url = 'https://graph.facebook.com/me?' . http_build_query(['access_token' => $oauthResult->getAccessToken()]);
        $response = $this->callUrl($url);

        $json = json_decode($response);

        if (JSON_ERROR_NONE === json_last_error()) {
            if (isset($json->error)) {
                throw new OAuthException($json->error->message, $json->error->code);
            }

            return new OAuthUser($json->id, $json->email, $json->first_name, $json->last_name);
        }

        throw new \LogicException('Unexpected response: '.$response);
    }
}