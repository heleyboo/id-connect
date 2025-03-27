<?php

namespace SonLeu\IDConnect\Api\Internal;

use SonLeu\IDConnect\Api\BaseApi;
use SonLeu\IDConnect\ApiException;

abstract class BaseInternalApi extends BaseApi
{
    protected $api_key;

    public function __construct()
    {
        parent::__construct();

        $this->api_key = config('id_connect.api_key');
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
        $resourcePath = sprintf('%s/%s', 'internal', trim($resourcePath,'/'));

        $headers = array_merge($headers, [
            'x-api-key' => $this->api_key,
        ]);

        return parent::callApi($resourcePath, $method, $queryParams, $httpBody, $headers);
    }
}
