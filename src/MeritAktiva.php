<?php

namespace Jgangso\MeritApiClient;

use Jgangso\MeritApiClient\Exception\UnsupportedFeatureException;
use Jgangso\MeritApiClient\Service\CustomerService;
use Jgangso\MeritApiClient\Service\SalesInvoiceService;
use Jgangso\MeritApiClient\Util\MeritApiClient;

class MeritAktiva
{
    
    public const MERIT_API_BASE_EE = 'https://aktiva.merit.ee/api';
    public const MERIT_API_BASE_FI = 'https://aktiva.meritaktiva.fi/api';
    public const MERIT_API_BASE_PL = 'https://program.360ksiegowosc.pl/api';
    
    private MeritApiClient $client;
    
    /**
     * @param string $apiId
     * @param string $apiKey
     * @param string $country
     *
     * @throws \Jgangso\MeritApiClient\Exception\UnsupportedFeatureException
     */
    public function __construct(string $apiId, string $apiKey, string $country)
    {
        switch ($country) {
            case 'ee':
                $apiBase = self::MERIT_API_BASE_EE;
                break;
            case 'fi':
                $apiBase = self::MERIT_API_BASE_FI;
                break;
            case 'pl':
                $apiBase = self::MERIT_API_BASE_PL;
                break;
            default:
                throw new UnsupportedFeatureException('Unsupported country: '.$country);
        }
        
        $this->client = new MeritApiClient($apiId, $apiKey, $apiBase);
        
    }
    
    
    public function getSalesInvoiceService(): SalesInvoiceService {
        return new SalesInvoiceService($this->client);
    }
    
    public function getCustomerService(): CustomerService
    {
        return new CustomerService($this->client );
    }
    
}