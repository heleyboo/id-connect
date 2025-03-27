<?php

namespace SonLeu\IDConnect\Services\Staff;

use SonLeu\IDConnect\ApiException;
use SonLeu\IDConnect\Api\Staff\DepartmentApi;
use SonLeu\IDConnect\Models\Department;
use Illuminate\Support\Collection;

class DepartmentService
{
    /**
     * @return Collection|Department[]
     * @throws ApiException
     */
    public function listDeptChildren()
    {
        if (session()->has('listDeptChildren')) {
            return session()->get('listDeptChildren');
        }

        $response = (new DepartmentApi())->listDeptChildren();

        $departments = collect($response->getData()->getDepartments());

        session()->put('listDeptChildren', $departments);

        return $departments;
    }

    /**
     * @return array
     * @throws ApiException
     */
    public function getCurrentUserDepts()
    {
        return $this->listDeptChildren()->toArray();
    }
}
