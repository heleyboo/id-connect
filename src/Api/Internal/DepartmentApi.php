<?php

namespace SonLeu\IDConnect\Api\Internal;

use SonLeu\IDConnect\Models\GetDepartmentResponse;
use SonLeu\IDConnect\Models\ListDepartmentResponse;
use SonLeu\IDConnect\ApiException;
use SonLeu\IDConnect\ObjectSerializer;
use Exception;

class DepartmentApi extends BaseInternalApi
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array|object|null|ListDepartmentResponse
     * @throws ApiException|Exception
     */
    public function list()
    {
        list($data, $statusCode, $headers) = $this->callApi('departments', 'GET', [
            'pagination' => 'false',
        ]);

        return ObjectSerializer::deserialize($data, ListDepartmentResponse::class);
    }

    /**
     * @return array|object|null|ListDepartmentResponse
     * @throws ApiException|Exception
     */
    public function listTree()
    {
        list($data, $statusCode, $headers) = $this->callApi('departments', 'GET', [
            'pagination' => 'false',
            'search' => 'level_id:2',
            'recursive' => 'true'
        ]);

        return ObjectSerializer::deserialize($data, ListDepartmentResponse::class);
    }

    /**
     * @param int $department_id
     * @return array|object|null
     * @throws ApiException|Exception
     */
    public function listRecursive($department_id)
    {
        list($data, $statusCode, $headers) = $this->callApi('departments/' . $department_id . '/recursive', 'GET');

        return ObjectSerializer::deserialize($data, ListDepartmentResponse::class);
    }

    /**
     * @param int $id
     * @return array|object|null|GetDepartmentResponse
     * @throws ApiException|Exception
     */
    public function get($id)
    {
        list($data, $statusCode, $headers) = $this->callApi('departments/' . $id, 'GET');

        return ObjectSerializer::deserialize($data, GetDepartmentResponse::class);
    }
}
