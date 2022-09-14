<?php

namespace Jgangso\MeritApiClient\Model;

abstract class AbstractModel
{
    
    protected $data;
    
    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = (object) $data;
    }
    
    
    protected function get( $key ){
        return $this->data->$key ?? null;
    }
    
    
    protected function set( $key, $value ){
        $this->data->$key = $value;
    }
    
    abstract public static function ofApiResponse( $data ): self;
    
    
    /**
     * @return bool|array
     */
    abstract public function validate();
    
    
    abstract public function toApiFormat(): array;
    
}