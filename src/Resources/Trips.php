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
     * @param string|int station UIC code of the station to depart from
     */
    public function departureStation($value) 
    {
        $this->originUicCode($value);

        return $this;
    }

    /**
     * @param string|int station UIC code of the station to depart from
     */
    public function originUicCode($value) 
    {
        $this->client->where('originUicCode', $value);

        return $this;
    }

    /**
     * @param string|int station UIC code of the destination station
     */
    public function destinationStation($value) 
    {
        $this->destinationUicCode($value);

        return $this;
    }

    /**
     * @param string|int station UIC code of the destination station
     */
    public function destinationUicCode($value) 
    {
        $this->client->where('destinationUicCode', $value);

        return $this;
    }

    /**
     * @param string $value the date time of the departure in RFC3339
     */
    public function departureDateTime($value) 
    {
        $this->dateTime($value);

        return $this;
    }
    
    /**
     * @param string $value the date time of the departure in RFC3339
     */
    public function dateTime($value) 
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
