<?php

namespace Morscate\NsClient\Resources;

class Stop extends Resource
{
    /**
     * The field with the resource's primary key.
     */
    protected string $primaryKeyFieldName = 'uicCode';

    /**
     * The attributes that should be mutated to dates.
     */
    protected array $dates = [
        'plannedDepartureDateTime',
        'plannedArrivalDateTime',
    ];

}
