<?php

namespace GenTux\tests;

use GenTux\Marketo\Api\CampaignApi;
use GenTux\Marketo\Api\CustomObjectApi;
use GenTux\Marketo\Api\LeadApi;
use GenTux\Marketo\Client;
use GenTux\Marketo\Exceptions\MissingRequiredPropertiesException;

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
    public function it_should_throw_an_exception_if_properties_are_missing()
    {
        $this->setExpectedException(MissingRequiredPropertiesException::class);
        new Client([]);
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

    /**
     * @test
     */
    public function it_should_initialize_custom_objects_api()
    {
        $client = new Client($this->fooProperties);

        $this->assertInstanceOf(CustomObjectApi::class, $client->customObjects());
    }
}