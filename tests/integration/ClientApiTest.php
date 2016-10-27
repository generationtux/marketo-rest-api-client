<?php

namespace GenTux\Marketo;


class ClientApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_set_an_access_token()
    {
        $properties = [
            'api_url' => 'foo',
            'client_id' => 'bar',
            'client_secret' => 'foobar'
        ];

        $client = new Client($properties);

        $client->auth()->setAccessToken();

        $this->assertNotEmpty($client->accessToken);
    }
}