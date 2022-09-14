<?php

namespace Jgangso\MeritApiClient\Util;

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Jgangso\MeritApiClient\Exception\ApiClientErrorException;
use Jgangso\MeritApiClient\Exception\ApiErrorException;

class MeritApiClient
{
    
    private Client $client;
    private string $apiId;
    private string $apiKey;
    private string $apiBase;
    
    public function __construct( string $apiId, string $apiKey, string $apiBase )
    {
        $this->apiId = $apiId;
        $this->apiKey = $apiKey;
        $this->apiBase = $apiBase;
    }
    
    protected function client(): Client
    {
        if ( ! isset($this->client)) {
            $this->client = new Client($this->apiBase);
        }
        
        return $this->client;
    }
    
    
    /**
     * @param string     $endpoint
     * @param            $payload
     * @param array|null $extra_headers
     *
     * @return mixed
     * @throws \Jgangso\MeritApiClient\Exception\ApiErrorException
     * @throws \Jgangso\MeritApiClient\Exception\ApiClientErrorException
     * @throws \Exception
     */
    public function request(string $endpoint, $payload, ?array $extra_headers)
    {
        $timestamp = $this->makeTimestamp();
        $payload   = json_encode($payload);
        
        $uri = $this->apiBase.'/'.$endpoint.'?ApiId='.$this->apiId.'&timestamp='.$timestamp.'&signature='.$this->makeSignature($timestamp, $payload);
        
        try {
            $response = $this->client()->post($uri, $extra_headers, $payload)->send();
        } catch ( ClientErrorResponseException $exception ) {
            throw new ApiClientErrorException('Merit Aktiva API Client error. Error: '.$exception->getMessage());
        }
        
        if ($response->isError()) {
            throw new ApiErrorException('Merit Aktiva API error: Status code: '.$response->getStatusCode().'. Error: '.$response->getBody(true));
        }
        
        $data = json_decode($response->getBody());
        
        if (null === $data) {
            throw new ApiErrorException('Unexpected response from Merit Aktiva API: '.$response->getBody(true));
        }
        
        return $data;
    }
    
    
    /**
     * @throws \Exception
     */
    private function makeTimestamp(): string
    {
        $timezone = new \DateTimeZone('UTC');
        
        $date = new \DateTimeImmutable('now', $timezone );
        
        return $date->format('YmdHis');
    }
    
    private function makeSignature(string $timestamp, string $payloadJSON): string
    {
        $signable = $this->apiId.$timestamp.$payloadJSON;
        
        $rawSig = hash_hmac('sha256', $signable, $this->apiKey, true);
        
        return base64_encode($rawSig);
    }
}