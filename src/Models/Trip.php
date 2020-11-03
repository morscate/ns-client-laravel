<?php

namespace Morscate\NsClient\Models;

use Illuminate\Support\Collection;

class Trip extends NsModel
{
    public Collection $legs;

    public function setLegsAttribute($legs) {
        $this->legs = collect([]);

        foreach ($legs as $leg) {
            $this->legs->add(new Leg((array) $leg));
        }
    }

    public function setProductFareAttribute($fare) {
        $this->productFare = new Fare((array) $fare);
    }
}
