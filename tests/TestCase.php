<?php

namespace GenTux\tests;

use GenTux\Marketo\Client;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Client stub for mocking Guzzle
     *
     * @param $body
     * @return Client
     */
    protected function clientStub($body)
    {
        $accessTokenBody = '{"access_token" : "foobaraccess"}';
        $mock = new MockHandler([
            new Response(200, ['Content-Type' => 'application/json'], $accessTokenBody),
            new Response(200, ['Content-Type' => 'application/json'], $body)
        ]);

        $handler = HandlerStack::create($mock);
        $guzzle = new Guzzle(['handler' => $handler]);

        return new Client([
            'api_url' => 'foo@bar.com',
            'client_id' => 'foobarid',
            'client_secret' => 'foobarkey'
        ], $guzzle);
    }
}