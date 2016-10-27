<?php

namespace GenTux\Marketo;


use GenTux\Marketo\Api\AuthApi;

class ClientTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function it_should_initialize_client_class()
    {
        $properties = [
            'api_url' => 'foo.bar/api',
            'client_id' => 'foobarid',
            'client_secret' => 'foobarsecret'
        ];
        $client = new Client($properties);

        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * @test
     */
    public function it_should_create_an_instance_of_auth_api()
    {
        $properties = [
            'api_url' => 'foo',
            'client_id' => 'bar',
            'client_secret' => 'foobar'
        ];

        $client = new Client($properties);

        $this->assertInstanceOf(AuthApi::class,$client->auth());
    }
}