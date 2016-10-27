<?php

namespace GenTux\Marketo;


use GenTux\Marketo\Api\AuthApi;
use GenTux\Marketo\Api\LeadsApi;
use GuzzleHttp\Client as Guzzle;

class Client
{
    /** @var string */
    public $url;

    /** @var string */
    public $clientId;

    /** @var string */
    public $clientSecret;

    /** @var string */
    public $accessToken;

    /** @var Guzzle */
    public $guzzle;

    public function __construct(array $properties, Guzzle $guzzle = null)
    {
        $this->url = $properties['api_url'];
        $this->clientId = $properties['client_id'];
        $this->clientSecret = $properties['client_secret'];

        $this->guzzle = $guzzle ?: new Guzzle();
    }

    public function leads()
    {
        return new LeadsApi($this);
    }

    public function auth()
    {
        return new AuthApi($this);
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }
}