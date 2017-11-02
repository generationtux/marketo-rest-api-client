<?php

namespace GenTux\Marketo\Api;

use GenTux\Marketo\Exceptions\MarketoApiException;

class CustomObjectApi extends BaseApi
{

    /**
     * Creates or updates a custom object
     *
     * @param string $name Object name
     * @param array $fields
     * @throws MarketoApiException
     *
     * @see http://developers.marketo.com/rest-api/endpoint-reference/lead-database-endpoint-reference/#!/Custom_Objects/syncCustomObjectsUsingPOST
     */
    public function createOrUpdate($name, array $fields)
    {
        $url = $this->client->url . "/rest/v1/customobjects/".$name.".json";
        $response = $this->post($url, [
            'action' => 'createOrUpdate',
            'input' => $fields
        ]);

        if (!$response->success) {
            throw new MarketoApiException('Error syncing custom object: ' . $response->errors[0]->message);
        }
    }
}