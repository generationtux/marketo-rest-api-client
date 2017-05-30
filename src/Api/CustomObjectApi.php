<?php

namespace GenTux\Marketo\Api;

use GenTux\Marketo\Client;
use GenTux\Marketo\Exceptions\LeadDoesNotExistException;
use GenTux\Marketo\Exceptions\MarketoApiException;

class CustomObjectApi extends BaseApi
{
    /** @var $customObjectName */
    public $customObjectName;
    /**
     * CustomObjectApi constructor.
     * @param string $customObjectName
     * @param Client $client
     */
    public function __construct(Client $client, $customObjectName)
    {
        parent::__construct($client);
        $this->customObjectName = $customObjectName;
    }

    /**
     * Create or Update custom object
     *
     * @param array $customObjects
     * @param string $lookupField
     * @param string $action
     * @throws MarketoApiException
     */
    public function sync(
        array $customObjects,
        $lookupField = "email",
        $action = "createOrUpdate"
    )
    {
        $url = $this->client->url . '/rest/v1/customobjects/' . $this->customObjectName . '.json';
        $response = $this->post($url , [
            'action' => $action,
            'lookupField' => $lookupField,
            'input' => $customObjects 
        ]);

        if (!$response->success) {
            throw new MarketoApiException('Error syncing custom object: ' . $response->errors[0]->message);
        }
    }

    /**
     * Deletes custom objects
     *
     * @param array $customObjectIds [ [ someUniqueIdentifer: 123 ], [ someUniqueIdentifier: 124 ] ]
     * @param string $deleteBy
     * @throws MarketoApiException
     */
    public function destroy(
        array $customObjectIds,
        $deleteBy = "dedupeFields"
    )
    {
        $url = $this->client->url . '/rest/v1/customobjects/' . $this->customObjectName . 'delete.json';
        $response = $this->delete($url, [
            'deleteBy' => $deleteBy,
            'input' => $customObjectIds
        ]);

        if (!$response->success) {
            throw new MarketoApiException('Error syncing custom object: ' . $response->errors[0]->message);
        }
    }
}