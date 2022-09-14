<?php

namespace Jgangso\MeritApiClient\Test;

use Jgangso\MeritApiClient\Model\SalesInvoice;
use PHPUnit\Framework\TestCase;

class SalesInvoiceTest extends TestCase
{
    
    public function testOfApiResponse()
    {
        $data = json_decode(file_get_contents(__DIR__.'/data/SalesInvoice.json'));
        $this->assertInstanceOf('Jgangso\MeritApiClient\Model\SalesInvoice', SalesInvoice::ofApiResponse($data));
    }
    
    public function testGetInvoiceNo()
    {
        $data = json_decode(file_get_contents(__DIR__.'/data/SalesInvoice.json'));
        $object = SalesInvoice::ofApiResponse($data);
        $this->assertEquals($data->InvoiceNo, $object->getInvoiceNo());
    }
}
