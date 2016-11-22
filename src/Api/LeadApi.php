<?php

namespace GenTux\Marketo\Api;

use GenTux\Marketo\Client;
use GenTux\Marketo\Exceptions\LeadDoesNotExistException;
use GenTux\Marketo\Exceptions\MarketoApiException;

class LeadApi extends BaseApi
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
     * Create leads
     *
     * @param array $leads
     * @throws MarketoApiException
     */
    public function create(array $leads)
    {
        $url = $this->client->url . "/rest/v1/leads.json";
        $response = $this->post($url , [ 'input' => $leads ]);

        if (!$response->success) {
            throw new MarketoApiException('Error creating lead: ' . $response->errors[0]->message);
        }
    }

    /**
     * Get a lead by email address
     *
     * @param string $email
     * @return \stdClass
     * @throws LeadDoesNotExistException
     * @throws MarketoApiException
     */
    public function show($email)
    {
        $url = $this->client->url . '/rest/v1/leads.json';
        $queryParams = [
            'filterType' => 'email',
            'filterValues' => $email
        ];
        $response = parent::get($url, $queryParams);
        if ($response->success) {
            if (count($response->result) > 0) {
                return $response->result[0];
            } else {
                throw new LeadDoesNotExistException('Lead does not exist with email ' . $email);
            }
        } else {
            throw new MarketoApiException('Error retrieving lead: ' . $response->errors[0]->message);
        }
    }
}