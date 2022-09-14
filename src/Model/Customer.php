<?php

namespace Jgangso\MeritApiClient\Model;

class Customer extends AbstractModel
{
    
    public function getId(){
        return $this->get('Id');
    }
    
    public static function ofApiResponse($data): Customer
    {
        return new self( $data );
    }
    
    public function toApiFormat(): array
    {
        return (array) $this->data;
    }
    
    public function validate()
    {
        // TODO: Implement validate() method.
    }
}