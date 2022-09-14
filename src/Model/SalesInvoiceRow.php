<?php

namespace Jgangso\MeritApiClient\Model;

class SalesInvoiceRow extends AbstractModel
{
    
    public static function ofApiResponse($data): AbstractModel
    {
        return new self( $data );
    }
    
    public function setItem( Item $item ){
        $this->set('Item', $item);
    }
    
    public function setQuantity( float $quantity ){
        $this->set('Quantity', $quantity);
    }
    
    public function setPrice( float $price ){
        $this->set('Price', $price);
    }
    
    public function setDiscountPercent( float $percent ){
        $this->set('DiscountPct', $percent);
    }
    
    public function setDiscountAmount( float $amount ){
        $this->set('DiscountAmount', $amount);
    }
    
    public function setTaxId( string $taxId ){
        $this->set('TaxId', $taxId);
    }
    
    public function validate()
    {
        // TODO: Implement validate() method.
    }
    
    public function toApiFormat(): array
    {
        $ret = (array) $this->data;
        
        $ret['Item'] = $this->get('Item')->toApiFormat();
        
        return $ret;
    }
}