<?php

namespace GenTux\tests;


use GenTux\Marketo\api\AuthApi;

class AuthApiTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_should_an_access_token_on_the_client_instance()
    {
        $body = '{"access_token":"foobaraccess"}';
        $client = $this->clientStub($body);
        $authApi = new AuthApi($client);
        $authApi->setAccessToken();
        $this->assertEquals('foobaraccess', $client->accessToken);
    }
}