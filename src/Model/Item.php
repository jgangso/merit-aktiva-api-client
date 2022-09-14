<?php

namespace Jgangso\MeritApiClient\Model;

class Item extends AbstractModel
{
    
    public static function ofApiResponse($data): AbstractModel
    {
        return new self( $data );
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