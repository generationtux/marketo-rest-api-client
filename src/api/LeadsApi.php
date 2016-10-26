<?php

namespace GenTux\Marketo\Api;


use GenTux\Marketo\Client;

class LeadsApi extends BaseApi
{
    /** @var Client */
    protected $client;

    /**
     * LeadsApi constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    public function create() {

    }
}