<?php

namespace Jgangso\MeritApiClient\Service;

use Jgangso\MeritApiClient\Model\SalesInvoice;
use Jgangso\MeritApiClient\Util\MeritApiClient;

class SalesInvoiceService extends MeritApiService
{
    
    protected const MERIT_API_QUERY_ENDPOINT = 'v2/getinvoices';
    protected const MERIT_API_CREATE_ENDPOINT = 'v2/sendinvoice';
    
    protected array $defaultQueryArgs = [];
    
    protected static string $modelClass = SalesInvoice::class;
    
    /**
     */
    public function __construct(MeritApiClient $client)
    {
        $this->defaultQueryArgs = [
            'Periodstart' => date('Ymd', strtotime('-3 months')),
            'PeriodEnd'   => date('Ymd', strtotime('now')),
            'UnPaid'      => 'false',
        ];
        
        parent::__construct($client);
    }
    
    
    /**
     * @param \Jgangso\MeritApiClient\Model\SalesInvoice|null $entity
     *
     * @return string
     */
    public function create(SalesInvoice $entity = null): string
    {
        $payload = $entity->toApiFormat();
        
        $response = $this->client()->request(self::MERIT_API_CREATE_ENDPOINT, $payload, null );
        
        var_dump($response);
    }
    
    
    /**
     * @param array{Periodstart: string, PeriodEnd: string, UnPaid: string} $args
     *
     * @return array|\Jgangso\MeritApiClient\Model\SalesInvoice[]
     * @throws \Jgangso\MeritApiClient\Exception\ApiClientErrorException
     * @throws \Jgangso\MeritApiClient\Exception\ApiErrorException
     */
    public function query(array $args): array
    {
        return parent::query($args);
    }
}