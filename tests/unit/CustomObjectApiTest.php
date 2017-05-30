<?php

namespace GenTux\tests;

use GenTux\Marketo\Api\CustomObjectApi;
use GenTux\Marketo\Exceptions\MarketoApiException;

class CustomObjectApiTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_sync_custom_objects()
    {
        $body = json_encode(['success' => true]);
        $client = $this->clientStub($body);

        $customObjectApi = new CustomObjectApi($client, 'member');
        $customObjects = [
            [
                'id' => uniqid(),
                'email' => 'someemail@test.com',
                'eventName' => 'Some Event'
            ],
            [
                'id' => uniqid(),
                'email' => 'someemail1@test.com',
                'eventName' => 'Some Event 2'
            ],
        ];
        $customObjectApi->sync($customObjects);
    }

    /**
     * @test
     */
    public function it_should_sync_custom_objects_from_the_client_interface()
    {
        $body = json_encode(['success' => true]);
        $client = $this->clientStub($body);

        $customObjects = [
            [
                'id' => uniqid(),
                'email' => 'someemail@test.com',
                'eventName' => 'Some Event'
            ],
            [
                'id' => uniqid(),
                'email' => 'someemail1@test.com',
                'eventName' => 'Some Event 2'
            ],
        ];
        $client->customObjects('member')->sync($customObjects);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_there_is_an_error_in_syncing()
    {
        $this->setExpectedException(MarketoApiException::class);
        $body = '{"success":false,"errors":[{"message":"There was an error creating or updating."}]}';
        $client = $this->clientStub($body);

        $customObjectApi = new CustomObjectApi($client, 'member');
        $customObjectApi->sync([
            [
                'email' => 'foolead@bar.com'
            ]
        ]);
    }
    /**
     * @test
     */
    public function it_should_delete_custom_objects()
    {
        $body = json_encode(['success' => true]);
        $client = $this->clientStub($body);
        $customObjectApi = new CustomObjectApi($client, 'member');
        $customObjectIds = [
            [
                'id' => uniqid(),
            ],
            [
                'id' => uniqid(),
            ],
        ];
        $customObjectApi->destroy($customObjectIds);
    }

    /**
     * @test
     */
    public function it_should_delete_custom_objects_from_the_client_interface()
    {
        $body = json_encode(['success' => true]);
        $client = $this->clientStub($body);

        $customObjectIds = [
            [
                'id' => uniqid(),
            ],
            [
                'id' => uniqid(),
            ],
        ];
        $client->customObjects('member')->destroy($customObjectIds);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_there_is_an_error_in_deleting()
    {
        $this->setExpectedException(MarketoApiException::class);
        $body = '{"success":false,"errors":[{"message":"There was an error deleting."}]}';
        $client = $this->clientStub($body);

        $customObjectApi = new CustomObjectApi($client, 'member');
        $customObjectApi->destroy([
            [
                'id' => uniqid(),
            ]
        ]);
    }
}