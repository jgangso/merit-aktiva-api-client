<?php

namespace Jgangso\MeritApiClient\Service;

use Jgangso\MeritApiClient\Model\Customer;
use Jgangso\MeritApiClient\Util\MeritApiClient;

class CustomerService extends MeritApiService
{
    
    protected const MERIT_API_QUERY_ENDPOINT = 'v1/getcustomers';
    
    protected static string $modelClass = Customer::class;
    
    public function __construct(MeritApiClient $client)
    {
        $this->defaultQueryArgs = [
            'Id'           => null,
            'RegNo'        => null,
            'VatRegNo'     => null,
            'Name'         => null,
            'WithComments' => null,
            'CommentsFrom' => null,
        ];
        
        parent::__construct($client);
    }
    
    
    /**
     * @param array{ Id: string, RegNo: string, VatRegNo: string, Name: string, WithComments: string, CommentsFrom: string} $args
     *
     * @return \Jgangso\MeritApiClient\Model\Customer[]
     * @throws \Jgangso\MeritApiClient\Exception\ApiClientErrorException
     * @throws \Jgangso\MeritApiClient\Exception\ApiErrorException
     */
    public function query(array $args): array
    {
        return parent::query($args);
    }
    
    public function create(): string
    {
        // TODO: Implement create() method.
    }
}