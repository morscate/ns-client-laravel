<?php

namespace Morscate\NsClient\Resources;

class Station extends NsResource
{
    /**
     * The API version the resources can be found in
     */
    protected $version = 'v2';

    protected $endpoint = 'stations';

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }
}
