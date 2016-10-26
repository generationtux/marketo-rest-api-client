<?php

namespace GenTux\Marketo\Api;


use GenTux\Marketo\Client;
use GenTux\Marketo\Exceptions\MarketoApiException;

class LeadsApi extends BaseApi
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
        parent::__construct();
    }

    public function create(array $leads)
    {
        $url = $this->client->url . '/rest/v1/leads.json';
        $response = $this->post($url , [ 'input' => $leads ]);

        if (!$response->success) {
            throw new MarketoApiException('Error creating lead: ' . $response->errors[0]->message);
        }
    }
}