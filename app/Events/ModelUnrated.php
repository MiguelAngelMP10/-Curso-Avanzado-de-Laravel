<?php

namespace App\Events;

namespace App\Events;

use Illuminate\Database\Eloquent\Model;

class ModelUnrated
{
    private $qualifier;
    private $rateable;

    public function __construct($qualifier,  $rateable)
    {
        $this->qualifier = $qualifier;
        $this->rateable = $rateable;
    }

    public function getQualifier(): Model
    {
        return $this->qualifier;
    }

    public function getRateable(): Model
    {
        return $this->rateable;
    }
}