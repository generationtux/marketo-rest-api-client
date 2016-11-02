<?php

namespace GenTux\Marketo\Api;

use GenTux\Marketo\Client;
use GenTux\Marketo\Exceptions\MarketoApiException;

class CampaignApi extends BaseApi
{
    /** @var Client */
    protected $client;

    /**
     * LeadsApi constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        parent::__construct($this->client->guzzle);
    }

    /**
     * Trigger a campaign for a lead
     *
     * @param $campaignId
     * @param $email
     * @param array $tokens
     * @throws MarketoApiException
     */
    public function trigger($campaignId, $email, array $tokens)
    {
        $lead = $this->client->leads()->get($email);
        $tokens = $this->parseTokens($tokens);
        $accessToken = $this->client->accessToken;
        $response = $this->post($this->client->url . "/rest/v1/campaigns/$campaignId/trigger.json?access_token=$accessToken",
            [
                'input' => [
                    'leads' => [
                        ['id' => $lead->id]
                    ],
                    'tokens' => $tokens
                ]
            ]
        );

        if (!$response->success) {
            throw new MarketoApiException('Error triggering campaign: ' . $response->errors[0]->message);
        }
    }

    /**
     * Parses an array of tokens and formats for sending in request
     *
     * @param array $tokens
     * @return array
     */
    private function parseTokens(array $tokens)
    {
        return array_map(function ($token, $key) {
            return ['name' => $key, 'value' => $token];
        }, $tokens, array_keys($tokens));
    }
}