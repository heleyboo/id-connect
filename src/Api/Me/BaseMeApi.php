<?php

namespace SonLeu\IDConnect\Api\Me;

use SonLeu\IDConnect\Api\BaseApi;
use SonLeu\IDConnect\ApiException;

abstract class BaseMeApi extends BaseApi
{
    protected $token;

    public function __construct()
    {
        parent::__construct();

        $this->token = auth('id')->token();
    }

    /**
     * @param $resourcePath
     * @param $method
     * @param array $queryParams
     * @param array $httpBody
     * @param array $headers
     * @return array
     * @throws ApiException
     */
    protected function callApi($resourcePath, $method, $queryParams = [], $httpBody = [], $headers = [])
    {
        $resourcePath = sprintf('%s/%s', 'me', trim($resourcePath,'/'));

        $headers = array_merge($headers, [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        return parent::callApi($resourcePath, $method, $queryParams, $httpBody, $headers);
    }
}
