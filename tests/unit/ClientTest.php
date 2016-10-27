<?php

namespace GenTux\Marketo;


use GenTux\Marketo\Api\AuthApi;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /** @var  array */
    protected $fooProperties;

    public function setUp()
    {
        parent::setUp();
        $this->fooProperties = [
            'api_url' => 'foo.bar/api',
            'client_id' => 'foobarid',
            'client_secret' => 'foobarsecret'
        ];
    }
    /**
     * @test
     */
    public function it_should_initialize_client_class()
    {
        $client = new Client($this->fooProperties);

        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * @test
     */
    public function it_should_create_an_instance_of_auth_api()
    {
        $client = new Client($this->fooProperties);

        $this->assertInstanceOf(AuthApi::class, $client->auth());
    }
}