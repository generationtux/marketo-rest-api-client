<?php

namespace GenTux\Marketo\Api;

use GenTux\Marketo\Exceptions\MarketoApiException;

class CustomActivitiesApi extends BaseApi
{

    /**
     * Create a new custom activity
     *
     * @param array $fields
     * @throws MarketoApiException
     *
     * @see http://developers.marketo.com/rest-api/endpoint-reference/lead-database-endpoint-reference/#!/Activities/addCustomActivityUsingPOST
     */
    public function create(array $fields)
    {
        $url = $this->client->url . "/rest/v1/activities/external.json";
        $response = $this->post($url, ['input' => $fields]);

        if (!$response->success) {
            throw new MarketoApiException('Error creating custom activity: ' . $response->errors[0]->message);
        }
    }
}