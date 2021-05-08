<?php

namespace Morscate\NsClient\Resources;

class Leg extends Resource
{
    /**
     * The field with the resource's primary key.
     */
    protected string $primaryKeyFieldName = 'journeyDetailRef';

    protected array $relationships = [
//        'origin'      => Stop::class,
//        'destination' => Stop::class,
        'stops' => Stop::class,
    ];
}
