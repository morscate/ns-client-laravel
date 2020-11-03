<?php

namespace Morscate\NsClient\Resources;

use Morscate\NsClient\Models\Leg;

class Trips extends NsResource
{
    /**
     * The API version the resources can be found in
     */
    protected $version = 'v3';

    protected $endpoint = 'trips';

    protected $modelClass = \Morscate\NsClient\Models\Trip::class;

    public function getVersion(): string
    {
        return $this->version;
    }
    
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getModelClass(): string
    {
        return $this->modelClass;
    }

    /**
     * UIC: 1000440
     */
    public function departureStation($value) 
    {
        $this->client->where('originUicCode', $value);

        return $this;
    }

    public function destinationStation($value) 
    {
        $this->client->where('destinationUicCode', $value);

        return $this;
    }

    public function departureDateTime($value) 
    {
        $this->client->where('dateTime', $value);

        return $this;
    }

    public function all()
    {
        $modelClass = $this->getModelClass();

        $trips = [];
        foreach ($this->client->all()->trips as $key => $trip) {
            $trips[$key] = new $modelClass((array) $trip);
        }

        return collect($trips);
    }
}
