<?php

namespace SonLeu\IDConnect\Models;

use SonLeu\IDConnect\AbstractModel;

class GetPositionData extends AbstractModel
{
    /** @var array */
    protected $position;

    protected static $typeMap = [
        'position' => Position::class
    ];

    protected static $attributeMap = [
        'position' => 'position'
    ];

    protected static $getters = [
        'position' => 'getPosition'
    ];

    protected static $setters = [
        'position' => 'setPosition'
    ];

    /**
     * GetUserData constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->position = isset($data['position']) ? $data['position'] : null;
        }

        if (config('id_connect.models.position')) {
            static::$typeMap['position'] = config('id_connect.models.position');
        }
    }

    /**
     * @return Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param array $position
     * @return GetPositionData
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}
