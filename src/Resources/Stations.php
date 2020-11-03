<?php

namespace Morscate\NsClient\Resources;

use Morscate\NsClient\Exceptions\InvalidArgumentException;

class Stations extends NsResource
{
    protected $endpoint = 'stations';

    protected $modelClass = \Morscate\NsClient\Models\Station::class;
    
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
        throw new InvalidArgumentException('Stations can\'t be queried.');

        return $this;
    }
}
