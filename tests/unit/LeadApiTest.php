<?php

namespace GenTux\tests;

use GenTux\Marketo\Api\LeadApi;
use GenTux\Marketo\Exceptions\LeadDoesNotExistException;
use GenTux\Marketo\Exceptions\MarketoApiException;

class LeadApiTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_create_a_lead()
    {
        $body = json_encode(['success' => true]);
        $client = $this->clientStub($body);

        $leadApi = new LeadApi($client);
        $leadApi->create([
            [
                'email' => 'foolead@bar.com'
            ]
        ]);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_there_is_an_error_in_lead_creation()
    {
        $this->setExpectedException(MarketoApiException::class);
        $body = '{"success":false,"errors":[{"message":"There was an error creating this lead"}]}';
        $client = $this->clientStub($body);

        $leadApi = new LeadApi($client);
        $leadApi->create([
            [
                'email' => 'foolead@bar.com'
            ]
        ]);
    }

    /**
     * @test
     */
    public function it_should_get_a_lead()
    {
        $testEmail = uniqid();
        $body = '{"success":true,"result":[{"firstName":"Foo","lastName":"Bar","email":"'.$testEmail.'"}]}';
        $client = $this->clientStub($body);

        $leadApi = new LeadApi($client);
        $this->assertEquals($testEmail, $leadApi->show($testEmail)->email);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_lead_does_not_exist()
    {
        $this->setExpectedException(LeadDoesNotExistException::class);
        $testEmail = uniqid();
        $body = '{"success":true,"result":[]}';
        $client = $this->clientStub($body);

        $leadApi = new LeadApi($client);

        $this->assertEquals($testEmail, $leadApi->show($testEmail)->email);
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_if_there_is_an_error_getting_lead()
    {
        $this->setExpectedException(MarketoApiException::class);
        $testEmail = uniqid();
        $body = '{"success":false,"errors":[{"message":"There was an error creating this lead"}]}';
        $client = $this->clientStub($body);
        $leadApi = new LeadApi($client);

        $this->assertEquals($testEmail, $leadApi->show($testEmail)->email);
    }
}