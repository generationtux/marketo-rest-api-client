<?php

namespace GenTux\tests;

use GenTux\Marketo\Api\CampaignApi;
use GenTux\Marketo\Client;
use GenTux\Marketo\Exceptions\MarketoApiException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Psr7\Response;

class CampaignApiTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_trigger_a_campaign()
    {
        $accessTokenBody = '{"access_token" : "foobaraccess"}';
        $leadBody = '{"success":true,"result":[{"firstName":"Foo","lastName":"Bar","email":"fooemail@email.com","id":1234}]}';
        $campaignBody = json_encode(['success' => true]);
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], $accessTokenBody),
            new Response(200, ['Content-Type' => 'application/json'], $leadBody),
            new Response(200, ['Content-Type' => 'application/json'], $campaignBody)
        ]);

        $handler = HandlerStack::create($mock);
        $guzzle = new Guzzle(['handler' => $handler]);

        $client = new Client([
            'api_url' => 'foo@bar.com',
            'client_id' => 'foobarid',
            'client_secret' => 'foobarkey'
        ], $guzzle);


        $campaignApi = new CampaignApi($client);
        $campaignApi->trigger(123, 'foobar@email.com',
            [
                '{{my.name}}' => 'Foo'
            ]
        );
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_is_success_is_false()
    {
        $this->setExpectedException(MarketoApiException::class);
        $accessTokenBody = '{"access_token" : "foobaraccess"}';
        $leadBody = '{"success":true,"result":[{"firstName":"Foo","lastName":"Bar","email":"fooemail@email.com","id":1234}]}';
        $campaignBody = '{"success":false,"errors":[{"message":"There was an error creating this lead"}]}';
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], $accessTokenBody),
            new Response(200, ['Content-Type' => 'application/json'], $leadBody),
            new Response(200, ['Content-Type' => 'application/json'], $campaignBody)
        ]);

        $handler = HandlerStack::create($mock);
        $guzzle = new Guzzle(['handler' => $handler]);

        $client = new Client([
            'api_url' => 'foo@bar.com',
            'client_id' => 'foobarid',
            'client_secret' => 'foobarkey'
        ], $guzzle);


        $campaignApi = new CampaignApi($client);
        $campaignApi->trigger(123, 'foobar@email.com',
            [
                '{{my.name}}' => 'Foo'
            ]
        );
    }
}