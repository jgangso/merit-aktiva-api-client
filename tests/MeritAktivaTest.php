<?php

namespace Jgangso\MeritApiClient\Test;

use Jgangso\MeritApiClient\MeritAktiva;
use PHPUnit\Framework\TestCase;

class MeritAktivaTest extends TestCase
{
    
    /**
     * @var \Jgangso\MeritApiClient\MeritAktiva
     */
    protected MeritAktiva $merit;
    
    protected function setUp(): void
    {
        $this->merit = new MeritAktiva($_ENV['MERIT_API_ID'], $_ENV['MERIT_API_KEY'], $_ENV['MERIT_API_LOCALE']);
        parent::setUp();
    }
    
    
    public function test__construct()
    {
        $this->assertInstanceOf('Jgangso\MeritApiClient\MeritAktiva',
            $this->merit
        );
    }
    
    
    public function testGetSalesInvoiceService()
    {
        $SIS = $this->merit->getSalesInvoiceService();
        
        $this->assertInstanceOf('Jgangso\MeritApiClient\Service\SalesInvoiceService', $SIS);
    }
    
    public function testGetCustomerService()
    {
        $CS = $this->merit->getCustomerService();
        
        $this->assertInstanceOf('Jgangso\MeritApiClient\Service\CustomerService', $CS );
    }
    
}
