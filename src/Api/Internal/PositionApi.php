<?php

namespace SonLeu\IDConnect\Api\Internal;

use SonLeu\IDConnect\Models\GetPositionResponse;
use SonLeu\IDConnect\ApiException;
use SonLeu\IDConnect\Models\ListPositionResponse;
use SonLeu\IDConnect\ObjectSerializer;
use Exception;

class PositionApi extends BaseInternalApi
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array|object|null|ListPositionResponse
     * @throws ApiException|Exception
     */
    public function list()
    {
        list($data, $statusCode, $headers) = $this->callApi('positions', 'GET', [
            'pagination' => 'false',
        ]);

        return ObjectSerializer::deserialize($data, ListPositionResponse::class);
    }

    /**
     * @param int $department_id
     * @param bool $recursive
     * @return array|object|null
     * @throws ApiException
     */
    public function listByDepartment($department_id, $recursive = false)
    {
        list($data, $statusCode, $headers) = $this->callApi('departments/' . $department_id . '/positions', 'GET', [
            'pagination' => 'false',
        ], [
            'recursive' => $recursive,
        ]);

        return ObjectSerializer::deserialize($data, ListPositionResponse::class);
    }

    /**
     * @param int $id
     * @return array|object|null|GetPositionResponse
     * @throws ApiException|Exception
     */
    public function get($id)
    {
        list($data, $statusCode, $headers) = $this->callApi('positions/' . $id, 'GET');

        return ObjectSerializer::deserialize($data, GetPositionResponse::class);
    }
}
