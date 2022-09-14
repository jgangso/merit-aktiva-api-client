<?php

namespace Jgangso\MeritApiClient\Test;

use Jgangso\MeritApiClient\Exception\ApiClientErrorException;
use Jgangso\MeritApiClient\Model\Customer;
use Jgangso\MeritApiClient\Model\SalesInvoice;
use Jgangso\MeritApiClient\Model\SalesInvoiceRow;

class SalesInvoiceServiceTest extends MeritAktivaTest
{
    
    public function testQuery()
    {
        $SIS  = $this->merit->getSalesInvoiceService();
        $list = $SIS->query([]);
        $this->assertIsArray($list);
    }
    
    
    /**
     * Test with 7 months range. Merit Aktiva docs says that max range is 3 months, but
     * currently it accepts ranges of up to 6 months.
     *
     * @return void
     * @throws \Jgangso\MeritApiClient\Exception\ApiClientErrorException
     * @throws \Jgangso\MeritApiClient\Exception\ApiErrorException
     */
    public function testGetListWithTooWideRange()
    {
        $SIS = $this->merit->getSalesInvoiceService();
        
        $this->expectException(ApiClientErrorException::class);
        
        $SIS->query([
            'Periodstart' => date('Ymd', strtotime('-7 months')),
        ]);
    }
    
    
    public function testCreateSalesInvoice()
    {
        $SIS = $this->merit->getSalesInvoiceService();
        
        $data = json_decode(file_get_contents(__DIR__ . '/data/SalesInvoice.json'));
        $entity = SalesInvoice::ofApiResponse($data );
        
        $customer = json_decode(file_get_contents(__DIR__. '/data/Customer.json'));
        $customer_entity = Customer::ofApiResponse($customer);
        
        $entity->setCustomer($customer_entity);
        
        
        $invoice_row = SalesInvoiceRow::ofApiResponse($data);
        $response = $SIS->create($entity);
        
        $this->assertIsArray($response);
    }
    
}
