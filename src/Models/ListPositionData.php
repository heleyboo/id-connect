<?php

namespace SonLeu\IDConnect\Models;

use SonLeu\IDConnect\AbstractModel;

class ListPositionData extends AbstractModel
{
    /** @var array */
    protected $positions;

    protected static $typeMap = [
        'positions' => Position::class . '[]',
    ];

    protected static $attributeMap = [
        'positions' => 'positions'
    ];

    protected static $getters = [
        'positions' => 'getPositions'
    ];

    protected static $setters = [
        'positions' => 'setPositions'
    ];

    /**
     * ListPositionData constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->positions = isset($data['positions']) ? $data['positions'] : null;
        }

        if (config('id_connect.models.position')) {
            static::$typeMap['positions'] = config('id_connect.models.position') . '[]';
        }
    }

    /**
     * @return Position[]
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * @param array $positions
     * @return ListPositionData
     */
    public function setPositions($positions)
    {
        $this->positions = $positions;
        return $this;
    }
}
