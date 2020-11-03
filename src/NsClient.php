<?php

namespace Morscate\NsClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class NsClient
{
    private $client;

    /**
     * The API version the resources can be found in
     */
    protected $version;

    /**
     * The endpoint of the resource.
     */
    protected $endpoint;

    /**
     * The query.
     */
    public $query = [];

    public function __construct(string $endpoint, string $version)
    {
        $this->endpoint = $endpoint;

        $this->version = $version;

        $this->client = new Client([
            'base_uri' => config('ns-client-laravel.base_uri') . $this->version . '/'
        ]);
    }

    /**
     * Make a NS GET request
     */
    public function get()
    {
        try {
            $response = $this->client->request('GET', $this->endpoint, [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => config('ns-client-laravel.api_key')
                ],
                'query' => $this->query
            ]);
        } catch (GuzzleException $exception){
            dd($exception);
        }

        return $response;
    }

    public function where(string $field, $value)
    {
        $this->query[$field] = $value;

        return $this;
    }

    /**
     * Return the resource(s)
     */
    public function all()
    {
        return json_decode($this->get()->getBody()->getContents());
    }
}
