<?php

namespace Morscate\NsClient\Resources;

use Carbon\Carbon;
use Morscate\NSClient\NsClient;

class Trip extends Resource
{
    /**
     * The API version the resources can be found in
     */
    protected string $version = 'v3';

    protected string $endpoint = 'trips';

    /**
     * The field with the resource's primary key.
     */
    protected string $primaryKeyFieldName = 'uid';

    protected array $relationships = [
        'legs'        => Leg::class,
        'productFare' => Fare::class,
    ];

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string|int station UIC code of the station to depart from
     */
    public function scopeDepartureStation(NsClient $client, $value): NsClient
    {
        $client->originUicCode($value);

        return $client;
    }

    /**
     * @param string|int station UIC code of the station to depart from
     */
    public function scopeOriginUicCode(NsClient $client, $value): NsClient
    {
        $client->where('originUicCode', $value);

        return $client;
    }

    /**
     * @param string|int station UIC code of the destination station
     */
    public function scopeDestinationStation(NsClient $client, $value): NsClient
    {
        $client->destinationUicCode($value);

        return $client;
    }

    /**
     * @param string|int station UIC code of the destination station
     */
    public function scopeDestinationUicCode(NsClient $client, $value): NsClient
    {
        $client->where('destinationUicCode', $value);

        return $client;
    }

    /**
     * @param Carbon $value the date time of the departure in RFC3339
     */
    public function scopeDepartureDateTime(NsClient $client, Carbon $value): NsClient
    {
        $client->dateTime($value);

        return $client;
    }

    /**
     * @param Carbon $value the date time of the departure in RFC3339
     */
    public function scopeDateTime(NsClient $client, Carbon $value): NsClient
    {
        $client->where('dateTime', $value->toRfc3339String());

        return $client;
    }
}
