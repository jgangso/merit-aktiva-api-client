<?php

namespace Jgangso\MeritApiClient\Model;

use Jgangso\MeritApiClient\Util\MeritDateTime;

class SalesInvoice extends AbstractModel
{
    
    protected array $invoiceRows;
    
    public function setDocDate( MeritDateTime $date ){
        $this->set('DocDate', $date);
    }
    
    public function setDueDate( MeritDateTime $date ){
        $this->set('DueDate', $date);
    }
    
    public function setTransactionDate( MeritDateTime $date ){
        $this->set('TransactionDate', $date);
    }
    
    public function setInvoiceNo( string $invoice_no ){
        $this->set('InvoiceNo', $invoice_no);
    }
    
    public function setCurrencyCode( string $ccode ){
        $this->set('CurrencyCode', $ccode);
    }
    
    public function setPayment( Payment $payment ){
        if( true === $payment->validate() ){
            $this->set('Payment', $payment);
        }
    }
    
    public function getInvoiceNo(): ?string
    {
        return $this->get('InvoiceNo');
    }
    
    public static function ofApiResponse($data): SalesInvoice
    {
        return new self($data);
    }
    
    /**
     * @param \Jgangso\MeritApiClient\Model\Customer|string $customer A customer model or string which represents a existing customer name or Guid
     *
     * @return void
     */
    public function setCustomer($customer)
    {
        if (is_a($customer, 'Jgangso\MeritApiClient\Model\Customer')) {
            if (true === $customer->validate()) {
                $this->set('Customer', $customer);
            } else {
                throw new \InvalidArgumentException('Invalid customer model.');
            }
        } elseif (is_string($customer)) {
            $this->set('Customer', $customer);
        } else {
            throw new \InvalidArgumentException('Customer must be a customer model or string (guid or name)');
        }
    }
    
    public function addInvoiceRow(SalesInvoiceRow $invoiceRow)
    {
        if (true === $invoiceRow->validate()) {
            $this->invoiceRows[] = $invoiceRow;
        }
    }
    
    public function validate()
    {
        // TODO: Implement validate() method.
    }
    
    public function toApiFormat(): array
    {
        $ret = (array)$this->data;
        
        $customer = $this->get('Customer');
        
        $ret['Customer'] = is_string($customer) ? $customer : $customer->toApiFormat();
        
        $invoiceRows = array();
        
        foreach ($this->invoiceRows as $row) {
            $invoiceRows[] = $row->toApiFormat();
        }
        
        $ret['InvoiceRow'] = $invoiceRows;
        
        $ret['DocDate'] = $this->get('DocDate')->toApiFormat();
        $ret['DueDate'] = $this->get('DueDate')->toApiFormat();
        $ret['TransactionDate'] = $this->get('TransactionDate')->toApiFormat();
        
        $ret['Payment'] = $this->get('Payment')->toApiFormat();
        
        return $ret;
    }
}