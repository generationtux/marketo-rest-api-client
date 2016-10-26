<?php

namespace GenTux\Marketo;


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

}