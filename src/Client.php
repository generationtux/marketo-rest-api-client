<?php

namespace GenTux\Marketo;

use GenTux\Marketo\Api\CampaignApi;
use GenTux\Marketo\Api\LeadApi;
use GenTux\Marketo\Api\CustomObjectApi;
use GenTux\Marketo\Exceptions\MissingRequiredPropertiesException;
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

    /**
     * Client constructor.
     * @param array $properties
     * @param Guzzle|null $guzzle
     * @throws MissingRequiredPropertiesException
     */
    public function __construct(array $properties, Guzzle $guzzle = null)
    {
        if (!isset($properties['api_url']) || !isset($properties['client_id']) || !isset($properties['client_secret'])) {
            throw new MissingRequiredPropertiesException("api_url, client_id, and client_secret must be set to instantiate this object.");
        }

        $this->url = $properties['api_url'];
        $this->clientId = $properties['client_id'];
        $this->clientSecret = $properties['client_secret'];

        $this->guzzle = $guzzle ?: new Guzzle();
    }

    /**
     * @return LeadApi
     */
    public function leads()
    {
        return new LeadApi($this);
    }

    /**
     * @return CampaignApi
     */
    public function campaign()
    {
        return new CampaignApi($this);
    }

    /**
     * @return CustomObjectApi
     */
    public function customObjects()
    {
        return new CustomObjectApi($this);
    }

    /**
     * @param $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }
}