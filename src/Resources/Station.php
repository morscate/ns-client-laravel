<?php

namespace Morscate\NsClient\Resources;

use Morscate\NsClient\Exceptions\InvalidArgumentException;

class Station extends NsResource
{
    protected $endpoint = 'stations';

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function where(string $field, $value)
    {
        throw new InvalidArgumentException('Stations can\'t be queried.');

        return $this;
    }
}
