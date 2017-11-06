<?php

namespace GenTux\tests;

use GenTux\Marketo\Api\CustomActivitiesApi;
use GenTux\Marketo\Exceptions\MarketoApiException;

class CustomActivitiesApiTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_a_new_custom_activity()
    {
        $body = json_encode(['success' => true]);
        $client = $this->clientStub($body);

        $api = new CustomActivitiesApi($client);
        $api->create([
            'leadId' => 'foo'
        ]);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_there_is_an_error_creating_a_custom_activity()
    {
        $this->setExpectedException(MarketoApiException::class);
        $body = '{"success":false,"errors":[{"message":"There was an error creating the custom activity."}]}';
        $client = $this->clientStub($body);

        $api = new CustomActivitiesApi($client);
        $api->create([
            'leadId' => 'foo'
        ]);
    }
}