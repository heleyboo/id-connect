<?php

namespace SonLeu\IDConnect\Api\Me;

use SonLeu\IDConnect\Models\GetUserResponse;
use SonLeu\IDConnect\Models\ListDepartmentResponse;
use SonLeu\IDConnect\ApiException;
use SonLeu\IDConnect\Models\User;
use SonLeu\IDConnect\ObjectSerializer;
use Exception;

class MeApi extends BaseMeApi
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $password
     * @return array|\DateTime|object|\SonLeu\IDConnect\AbstractModel|\SplFileObject|null
     * @throws ApiException
     */
    public function changePassword($password)
    {
        list($data, $statusCode, $headers) = $this->callApi('change-password', 'POST', [], [
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        return ObjectSerializer::deserialize($data, GetUserResponse::class);
    }
}
