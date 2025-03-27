<?php

namespace SonLeu\IDConnect\Services\Internal;

use Illuminate\Support\Facades\Cache;
use SonLeu\IDConnect\Api\Internal\PositionApi;
use SonLeu\IDConnect\ApiException;
use Illuminate\Support\Collection;
use SonLeu\IDConnect\Models\Position;

class PositionService
{
    /**
     * @return Collection|Position[]
     * @throws ApiException
     */
    public function list()
    {
        $cache_name = 'listPosition';

        if (Cache::has($cache_name)) {
            return Cache::get($cache_name);
        }

        $response = (new PositionApi())->list();

        $positions = collect($response->getData()->getPositions());

        Cache::put($cache_name, $positions, config('id_connect.cache.ttl'));

        return $positions;
    }

    /**
     * @param int $department_id
     * @param bool $recursive
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listByDepartment($department_id, $recursive = false)
    {
        $cache_name = 'listPositionInDepartment' . $department_id . ($recursive ? 'recursive' : '');

        if (Cache::has($cache_name)) {
            return Cache::get($cache_name);
        }

        $response = (new PositionApi())->listByDepartment($department_id, $recursive);

        $positions = collect($response->getData()->getPositions());

        Cache::put($cache_name, $positions, config('id_connect.cache.ttl'));

        return $positions;
    }

    /**
     * @param int $position_id
     * @return Position|null
     * @throws ApiException|\Exception
     */
    public function getById($position_id)
    {
        $positions = $this->list();

        return $positions->filter(function (Position $position) use ($position_id) {
            return $position->getId() == $position_id;
        })->first();
    }
}
