<?php

namespace GenTux\Marketo;


class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_initialize_client_class()
    {
        $client = new Client();

        $this->assertInstanceOf(Client::class, $client);
    }

}