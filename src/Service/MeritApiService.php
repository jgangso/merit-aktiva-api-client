<?php

namespace Jgangso\MeritApiClient\Service;

use Jgangso\MeritApiClient\Model\AbstractModel;
use Jgangso\MeritApiClient\Util\MeritApiClient;

abstract class MeritApiService
{
    
    protected const MERIT_API_QUERY_ENDPOINT = '';
    
    private MeritApiClient $client;
    
    protected array         $defaultQueryArgs = [];
    
    protected static string $modelClass = AbstractModel::class;
    
    public function __construct(MeritApiClient $client)
    {
        $this->client = $client;
    }
    
    /**
     *
     * @param array $args
     *
     * @return static[]
     * @throws \Jgangso\MeritApiClient\Exception\ApiClientErrorException
     * @throws \Jgangso\MeritApiClient\Exception\ApiErrorException
     */
    public function query(array $args): array
    {
        // Default array must include all possible query arguments
        // Ignore any argument which is not present in default array
        $args = array_intersect_key($args, $this->defaultQueryArgs);
        
        // Merge default values to the query
        $args = array_merge($this->defaultQueryArgs, $args);
        
        $response = $this->client()->request(static::MERIT_API_QUERY_ENDPOINT, $args, null);
    
        $ret = [];
        
        foreach ($response as $item) {
            $ret[] = static::$modelClass::ofApiResponse($item);
        }
        
        return $ret;
    }
    
    
    protected function client(): MeritApiClient
    {
        return $this->client;
    }
    
    abstract public function create(): string;
    
}