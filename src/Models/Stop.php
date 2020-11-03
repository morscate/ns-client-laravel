<?php

namespace Morscate\NsClient\Models;

class Stop extends NsModel
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'plannedDepartureDateTime',
        'actualDepartureDateTime',
    ];
    
}
