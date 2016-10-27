<?php

namespace GenTux\Marketo\Api;


use GuzzleHttp\Client as Guzzle;

class BaseApi
{
    /** @var Guzzle */
    private $guzzle;

    public function __construct(Guzzle $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function get($url)
    {
        return $this->request($url, 'GET');
    }

    public function post($url, $data)
    {
        return $this->request($url, 'POST', $data);
    }

    public function put($url, $data)
    {
        return $this->request($url, 'PUT', $data);
    }

    public function delete($url, $data)
    {
        return $this->request($url, 'DELETE', $data);
    }

    public function request($url, $method, array $data = [])
    {
        $response = $this->guzzle->request($method, $url , ['json' => $data])
            ->getBody()
            ->getContents();

        return json_decode($response);
    }
}