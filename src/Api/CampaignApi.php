<?php

namespace GenTux\Marketo\Api;

use GenTux\Marketo\Client;
use GenTux\Marketo\Exceptions\MarketoApiException;

class CampaignApi extends BaseApi
{
    /**
     * LeadsApi constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
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
        $response = $this->post($this->client->url . "/rest/v1/campaigns/$campaignId/trigger.json",
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