<?php

namespace SonLeu\IDConnect\Api;

use SonLeu\IDConnect\ApiException;

/**
 * Class LoginApi
 * @package SonLeu\IDConnect\Api
 */
class LoginApi extends BaseApi
{
    /**
     * @param $credentials
     * @return mixed
     * @throws ApiException
     */
    public function login($credentials)
    {
        list($data, $statusCode, $headers) = $this->callApi('auth/login', 'POST', $credentials);

        return $data->data;
    }

    /**
     * @param $code
     * @return mixed
     * @throws ApiException
     */
    public function resetPassword($code)
    {
        $params = [
            'login' => $code,
        ];

        list($data, $statusCode, $headers) = $this->callApi('auth/password/email', 'POST', $params);

        return $data;
    }
}
