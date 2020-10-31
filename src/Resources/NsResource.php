<?php

namespace Morscate\NsClient\Resources;

use Morscate\NsClient\Interfaces\NsModelInterface;
use Morscate\NsClient\NsClient;

class NsResource implements NsModelInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new NsClient($this->getEndpoint());
    }

    public function getEndpoint(): string
    {
        return '';
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

    public function toArray()
    {
        return $this->client->toArray();
    }
}
