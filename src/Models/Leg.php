<?php

namespace Morscate\NsClient\Models;

class Leg extends NsModel
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat;

    public function setStopsAttribute($stops) {
        $this->stops = collect([]);

        foreach ($stops as $stop) {
            $this->stops->add(new Stop((array) $stop));
        }

        dd($this->stops);
    }

}
