<?php

namespace GenTux\tests;


use GenTux\Marketo\api\AuthApi;
use GenTux\Marketo\api\CampaignApi;
use GenTux\Marketo\api\LeadApi;
use GenTux\Marketo\Client;

class ClientTest extends TestCase
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
    public function it_should_initialize_auth_api_class()
    {
        $client = new Client($this->fooProperties);

        $this->assertInstanceOf(AuthApi::class, $client->auth());
    }

    /**
     * @test
     */
    public function it_should_initialize_lead_api_class()
    {
        $client = new Client($this->fooProperties);

        $this->assertInstanceOf(LeadApi::class, $client->leads());
    }

    /**
     * @test
     */
    public function it_should_initialize_campaign_api_class()
    {
        $client = new Client($this->fooProperties);

        $this->assertInstanceOf(CampaignApi::class, $client->campaign());
    }
}