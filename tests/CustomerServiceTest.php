<?php

namespace Jgangso\MeritApiClient\Test;

class CustomerServiceTest extends MeritAktivaTest
{
    public function testQuery()
    {
        $CS   = $this->merit->getCustomerService();
        $list = $CS->query([
            'Name' => $_ENV['MERIT_DEFAULT_CUSTOMER_NAME']
        ]);
        $this->assertIsArray($list);
    }
}
