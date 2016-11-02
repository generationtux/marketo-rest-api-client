<?php

namespace GenTux\Marketo\api;


use GuzzleHttp\Client as Guzzle;

class BaseApi
{
    /** @var Guzzle */
    private $guzzle;

    /**
     * BaseApi constructor.
     * @param Guzzle $guzzle
     */
    public function __construct(Guzzle $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * @param $url
     * @return mixed
     */
    public function get($url)
    {
        return $this->request($url, 'GET');
    }

    /**
     * @param $url
     * @param $data
     * @return mixed
     */
    public function post($url, $data)
    {
        return $this->request($url, 'POST', $data);
    }

    /**
     * @param $url
     * @param $data
     * @return mixed
     */
    public function put($url, $data)
    {
        return $this->request($url, 'PUT', $data);
    }

    /**
     * @param $url
     * @param $data
     * @return mixed
     */
    public function delete($url, $data)
    {
        return $this->request($url, 'DELETE', $data);
    }

    /**
     * @param $url
     * @param $method
     * @param array $data
     * @return mixed
     */
    public function request($url, $method, array $data = [])
    {
        $response = $this->guzzle->request($method, $url , ['json' => $data])
            ->getBody()
            ->getContents();

        return json_decode($response);
    }
}