<?php

namespace Morscate\NSClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\ForwardsCalls;
use Morscate\NsClient\Resources\Resource;

class NsClient
{
    use ForwardsCalls;

    private Client $client;

    private Resource $resource;

    /**
     * The API version the resources can be found in
     */
    protected string $version;

    private string $endpoint;

    private int $limitRequests;

    private array $query = [];

    public function __construct(Resource $resource)
    {
        $this->setResource($resource);

        $version = $resource->getVersion();

        $this->client = new Client([
            'base_uri' => config('ns-client-laravel.base_uri') . $version . '/',
        ]);
    }

    public function limitRequests(int $limit): self
    {
        $this->limitRequests = $limit;

        return $this;
    }

    public function where(string $field, $value): self
    {
        $this->query[$field] = $value;

        return $this;
    }

//    public function whereGuid(string $guid): self
//    {
//        $this->setEndpoint("{$this->endpoint}(guid'{{$guid}}')");
//
//        return $this;
//    }

//    public function find(string $primaryKey)
//    {
//        $response = $this
//            ->whereGuid($primaryKey)
//            ->get();
//
//        return $response->first();
//    }

    public function first()
    {
        return $this->get()->first();
    }

    /**
     * Get the results with max one request
     */
    public function get(): Collection
    {
        $resource = $this->getResource();
        $responseKey = $resource->getResponseKey();

        $response = $this->request('GET');

        $resources = collect();
        if (isset($response->$responseKey)) {
            foreach ($response->$responseKey as $item) {
                $resources->add(new $resource((array) $item));
            }
        } else {
            $resources->add(new $resource((array) $response));
        }

        return $resources;
    }

    /**
     * Get all the results by doing multiple requests
     */
    public function all(): Collection
    {
        $resource = $this->getResource();
        $responseKey = $resource->getResponseKey();

        $resources = collect();
        $i = 1;
        do {
            $response = $this->request('GET');

            foreach ($response->$responseKey as $item) {
                $resources->add(new $resource((array) $item));
            }

            $i++;
            $this->query['context'] = $response->scrollRequestForwardContext ?? '';
        } while ($i <= $this->limitRequests && !empty($response->scrollRequestForwardContext));

        return $resources;
    }

    public function request(string $method)
    {
        try {
            $response = $this->client->request($method, $this->endpoint, [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => config('ns-client-laravel.api_key'),
                ],
                'query' => $this->query,
            ]);
        } catch (GuzzleException $exception) {
            dd($exception);
        }

        return json_decode($response->getBody()->getContents());
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getResource(): Resource
    {
        return $this->resource;
    }

    public function setEndpoint($endpoint): self
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function setResource($resource): self
    {
        $this->resource = $resource;
        $this->setEndpoint($resource->getEndpoint());
        return $this;
    }

    /**
     * Apply the given scope on the current builder instance.
     *
     * @param callable $scope
     * @param array $parameters
     * @return NsClient
     */
    protected function callScope(callable $scope, $parameters = [])
    {
        array_unshift($parameters, $this);

        return $scope(...array_values($parameters)) ?? $this;
    }

    public function __call($method, $parameters)
    {
        if ($this->resource !== null && method_exists($this->resource, $scope = 'scope' . ucfirst($method))) {
            return $this->callScope([$this->resource, $scope], $parameters);
        }

        $this->forwardCallTo($this->query, $method, $parameters);

        return $this;
    }
}
