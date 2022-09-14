<?php

namespace Jgangso\MeritApiClient\Util;

class MeritDateTime extends \DateTime
{
    public function toApiFormat(){
        return $this->format('YmdHis');
    }
}