<?php

namespace GenTux\Marketo\Api;

use GenTux\Marketo\Client;

class BaseApi
{
    /** @var Client */
    protected $client;

    /**
     * BaseApi constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $url
     * @param $queryParams
     * @return mixed
     */
    public function get($url, $queryParams = [])
    {
        return $this->request($url, 'GET', [], $queryParams);
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
     * @param array $queryParams
     * @return mixed
     */
    public function request($url, $method, array $data = [], $queryParams = [])
    {
        if (!isset($this->client->accessToken)) {
            $this->setAccessToken();
        }

        $queryParams['access_token'] = $this->client->accessToken;
        $response = $this->client->guzzle->request($method, $url , [
            'json' => $data,
            'query' => $queryParams
        ])->getBody()->getContents();

        return json_decode($response);
    }

    /**
     * Set access token
     */
    private function setAccessToken()
    {
        $url = $this->client->url . '/identity/oauth/token';
        $clientId = $this->client->clientId;
        $clientSecret = $this->client->clientSecret;
        $queryString = "?grant_type=client_credentials&client_id=$clientId&client_secret=$clientSecret";

        $response = json_decode(
            $this->client->guzzle
                ->request('GET', $url . $queryString)
                ->getBody()
                ->getContents()
        );

        $this->client->setAccessToken($response->access_token);
    }
}