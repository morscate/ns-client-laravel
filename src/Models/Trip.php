<?php

namespace Morscate\NsClient\Models;

class Trip extends NsModel
{
    public $legs = [];

    public function setLegsAttribute($legs) {
        foreach ($legs as $leg) {
            $this->legs[] = new Leg((array) $leg);
        }
    }
}
