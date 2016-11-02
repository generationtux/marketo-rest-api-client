<?php

namespace GenTux\Marketo\api;


use GenTux\Marketo\Client;

class AuthApi extends BaseApi
{
    /** @var Client */
    protected $client;

    /**
     * AuthApi constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        parent::__construct($this->client->guzzle);
    }

    /**
     * Set an access token on the Client instance
     */
    public function setAccessToken()
    {
        $url = $this->client->url . '/identity/oauth/token';
        $clientId = $this->client->clientId;
        $clientSecret = $this->client->clientSecret;
        $queryString = "?grant_type=client_credentials&client_id=$clientId&client_secret=$clientSecret";

        $response = $this->get($url . $queryString);

        $this->client->setAccessToken($response->access_token);
    }
}