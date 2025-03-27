<?php

namespace SonLeu\IDConnect\Models;

class GetPositionResponse extends Response
{
    /** @var GetPositionData */
    protected $data;

    /**
     * @return GetPositionData
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param GetPositionData $data
     * @return GetPositionResponse
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    protected static $typeMap = [
        'success' => 'boolean',
        'error_code' => 'string',
        'message' => 'string',
        'data' => GetPositionData::class,
    ];

    protected static $attributeMap = [
        'success' => 'success',
        'error_code' => 'error_code',
        'message' => 'message',
        'data' => 'data',
    ];

    protected static $getters = [
        'success' => 'getSuccess',
        'error_code' => 'getErrorCode',
        'message' => 'getMessage',
        'data' => 'data',
    ];
    protected static $setters = [
        'success' => 'setSuccess',
        'error_code' => 'setErrorCode',
        'message' => 'setMessage',
        'data' => 'setData',
    ];
}
