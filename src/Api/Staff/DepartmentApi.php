<?php

namespace SonLeu\IDConnect\Api\Staff;

use SonLeu\IDConnect\Models\ListDepartmentResponse;
use SonLeu\IDConnect\ApiException;
use SonLeu\IDConnect\ObjectSerializer;
use Exception;

class DepartmentApi extends BaseStaffApi
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array|object|null|ListDepartmentResponse
     * @throws ApiException|Exception
     */
    public function listDeptChildren()
    {
        list($data, $statusCode, $headers) = $this->callApi('departments', 'GET', [
            'recursive' => 'children',
            'flatten' => 'true'
        ]);

        return ObjectSerializer::deserialize($data, ListDepartmentResponse::class);
    }
}
