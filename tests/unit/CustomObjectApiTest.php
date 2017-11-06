<?php

namespace GenTux\tests;

use GenTux\Marketo\Api\CustomObjectApi;
use GenTux\Marketo\Exceptions\MarketoApiException;

class CustomObjectApiTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_or_update_a_custom_object()
    {
        $body = json_encode(['success' => true]);
        $client = $this->clientStub($body);

        $api = new CustomObjectApi($client);
        $api->createOrUpdate('foo_object', [
            [
                'email' => 'foolead@bar.com'
            ]
        ]);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_there_is_an_error_creating_or_updating_custom_activities()
    {
        $this->setExpectedException(MarketoApiException::class);
        $body = '{"success":false,"errors":[{"message":"There was an error syncing the object."}]}';
        $client = $this->clientStub($body);

        $api = new CustomObjectApi($client);
        $api->createOrUpdate('foo_object', [
            [
                'email' => 'foolead@bar.com'
            ]
        ]);
    }
}