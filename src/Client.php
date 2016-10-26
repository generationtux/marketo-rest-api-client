<?php

namespace GenTux\Marketo;


use GenTux\Marketo\Api\LeadsApi;

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

    public function __construct(array $properties)
    {
        $this->url = $properties['api_url'];
        $this->clientId = $properties['client_id'];
        $this->clientSecret = $properties['client_secret'];
    }

    public function leads()
    {
        return new LeadsApi($this);
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }
}