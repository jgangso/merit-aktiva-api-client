<?php

namespace Jgangso\MeritApiClient\Model;

class Payment extends AbstractModel
{
    
    public static function ofApiResponse($data): AbstractModel
    {
        // TODO: Implement ofApiResponse() method.
    }
    
    public function validate()
    {
        // TODO: Implement validate() method.
    }
    
    public function toApiFormat(): array
    {
        return (array) $this->data;
    }
}