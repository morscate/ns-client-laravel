<?php

namespace Morscate\NsClient\Resources;

use Morscate\NsClient\Interfaces\NsResourceInterface;
use Morscate\NsClient\NsClient;

class NsResource implements NsResourceInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new NsClient($this->getEndpoint(), $this->getVersion());
    }

    public function getVersion(): string
    {
        return 'v2';
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getModelClass(): string
    {
        return $this->modelClass;
    }

    public function where(string $field, $value)
    {
        $this->client->where($field, $value);

        return $this;
    }

    public function get()
    {
        return $this->client->get();
    }

    public function all()
    {
        $modelClass = $this->getModelClass();

        foreach ($this->client->all()->payload as $resource) {
            $models[] = new $modelClass((array) $resource);
        }

        dd(collect($models));
        return collect($models);
    }
}
