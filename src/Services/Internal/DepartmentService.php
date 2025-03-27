<?php

namespace SonLeu\IDConnect\Services\Internal;

use Illuminate\Support\Facades\Cache;
use SonLeu\IDConnect\ApiException;
use SonLeu\IDConnect\Api\Internal\DepartmentApi;
use SonLeu\IDConnect\Models\Department;
use Illuminate\Support\Collection;

class DepartmentService
{
    /**
     * @return Collection|Department[]
     * @throws ApiException
     */
    public function list()
    {
        if (Cache::has('listDept')) {
            return Cache::get('listDept');
        }

        $response = (new DepartmentApi())->list();

        $departments = collect($response->getData()->getDepartments());

        Cache::put('listDept', $departments, config('id_connect.cache.ttl'));

        return $departments;
    }

    /**
     * @param int $department_id
     * @return Department|null
     * @throws ApiException|\Exception
     */
    public function getById($department_id)
    {
        $departments = $this->list();

        return $departments->filter(function (Department $department) use ($department_id) {
            return $department->getId() == $department_id;
        })->first();
    }

    /**
     * @param int $level_id
     * @return Collection|Department[]
     * @throws ApiException
     */
    public function listByLevel($level_id)
    {
        return $this->list()->filter(function (Department $department) use ($level_id) {
            return $department->getLevel()->getId() == $level_id;
        });
    }

    /**
     * @param int $parent_id
     * @return Collection|Department[]
     * @throws ApiException
     */
    public function listByParentId($parent_id)
    {
        $departments = $this->list();

        return $departments->filter(function (Department $department) use ($parent_id) {
            return $department->getParentId() == $parent_id;
        });
    }

    /**
     * Lấy phòng ban truyền vào & tất cả phòng ban con của nó. Không có cache
     *
     * @param int $department_id
     * @return Collection|Department[]
     * @throws ApiException
     */
    public function listRecursiveChildren($department_id)
    {
        $response = (new DepartmentApi())->listRecursive($department_id);

        return collect($response->getData()->getDepartments());
    }

    /**
     * @return Collection|Department[]
     * @throws ApiException
     */
    public function listTree()
    {
        if (Cache::has('listDeptTree')) {
            return Cache::get('listDeptTree');
        }

        $response = (new DepartmentApi())->listTree();

        $departments = collect($response->getData()->getDepartments());

        Cache::put('listDeptTree', $departments, config('id_connect.cache.ttl'));

        return $departments;
    }
}
