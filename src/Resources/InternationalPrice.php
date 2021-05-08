<?php

namespace Morscate\NsClient\Resources;

use Carbon\Carbon;
use Morscate\NSClient\NsClient;

class InternationalPrice extends Resource
{
    /**
     * The API version the resources can be found in
     */
    protected string $version = 'v2';

    protected string $endpoint = 'price/international';

    /**
     * The field with the resource's primary key.
     */
    protected string $primaryKeyFieldName = 'uid';

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Add the required request parameter to the request
     *
     * @return NsClient
     */
    public function scopeRequestParameter(NsClient $client): NsClient
    {
        $client->where('request', '{request}');

        return $client;
    }

    /**
     * @param NsClient $client
     * @param string|int station UIC code of the station to depart from
     * @return NsClient
     */
    public function scopeDepartureStation(NsClient $client, $value): NsClient
    {
        $client->fromStation($value);

        return $client;
    }

    /**
     * @param NsClient $client
     * @param string|int station UIC code of the station to depart from
     * @return NsClient
     */
    public function scopeFromStation(NsClient $client, $value): NsClient
    {
        $client->requestParameter($client);
        $client->where('fromStation', $value);

        return $client;
    }

    /**
     * @param NsClient $client
     * @param string|int station UIC code of the destination station
     * @return NsClient
     */
    public function scopeDestinationStation(NsClient $client, $value): NsClient
    {
        $client->toStation($value);

        return $client;
    }

    /**
     * @param NsClient $client
     * @param string|int station UIC code of the destination station
     * @return NsClient
     */
    public function scopeToStation(NsClient $client, $value): NsClient
    {
        $client->requestParameter($client);
        $client->where('toStation', $value);

        return $client;
    }

    /**
     * @param NsClient $client
     * @param Carbon $value the planned date time of the departure
     * @return NsClient
     */
    public function scopeDepartureDateTime(NsClient $client, Carbon $value): NsClient
    {
        $client->where('departureDateTime', $value->toRfc3339String());

        return $client;
    }

    /**
     * @param NsClient $client
     * @param Carbon $value the planned date time of the arrival
     * @return NsClient
     */
    public function scopeArrivalDateTime(NsClient $client, Carbon $value): NsClient
    {
        $client->where('arrivalDateTime', $value->toRfc3339String());

        return $client;
    }
}
