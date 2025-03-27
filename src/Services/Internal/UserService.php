<?php

namespace SonLeu\IDConnect\Services\Internal;

use Illuminate\Support\Facades\Cache;
use SonLeu\IDConnect\ApiException;
use SonLeu\IDConnect\Api\Internal\UserApi;
use SonLeu\IDConnect\Models\ListUserResponse;
use SonLeu\IDConnect\Models\User;
use Illuminate\Support\Collection;

class UserService
{
    /** @var User $user_login */
    private $user_login;

    public function __construct()
    {
        $this->user_login = auth('id')->user();
    }

    /**
     * @return Collection|User[]
     * @throws ApiException
     */
    public function list()
    {
        if (Cache::has('listUsers')) {
            return Cache::get('listUsers');
        }

        $response = (new UserApi())->list();

        $users = collect($response->getData()->getUsers());

        Cache::put('listUsers', $users, config('id_connect.cache.ttl'));

        return $users;
    }

    /**
     * @return Collection
     * @throws ApiException
     */
    public function listActive()
    {
        return $this->list()->where('is_active', true);
    }

    /**
     * @param int $department_id
     * @param bool $recursive
     * @return \Illuminate\Support\Collection
     * @throws ApiException
     */
    public function listByDept($department_id, $recursive = false)
    {
        $users = $this->listActive();

        if ($recursive) {
            $department_ids = array_column((new DepartmentService())->listRecursiveChildren($department_id)->toArray(), 'id');
        } else {
            $department_ids = [$department_id];
        }

        return $users->filter(function (User $user) use ($department_ids) {
            $position = $user->getPosition();

            if (!$position)
                return false;

            return in_array($position->getDepartment()->getId(), $department_ids);
        });
    }

    /**
     * @param int $user_id
     * @return User|null
     * @throws ApiException|\Exception
     */
    public function getById($user_id)
    {
        $users = $this->list();

        return $users->filter(function (User $user) use ($user_id) {
            return $user->getId() == $user_id;
        })->first();
    }

    /**
     * @param string $code
     * @return User|null
     * @throws ApiException
     */
    public function getByCode($code)
    {
        $users = $this->list();

        return $users->filter(function (User $user) use ($code) {
            return strcasecmp($user->getCode(), $code) == 0;
        })->first();
    }

    /**
     * @param User|int $user
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listDirectStaffsOfUser($user)
    {
        $id = $user instanceof User ? $user->getId() : $user;

        /** @var ListUserResponse $response */
        $response = (new UserApi())->listDirectStaffs($id);

        return collect($response->getData()->getUsers());
    }

    /**
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listDirectStaffsOfCurrentUser()
    {
        if (session()->has('listDirectStaffs')) {
            return session()->get('listDirectStaffs');
        }

        /** @var User $user */
        $user = auth('id')->user();

        $direct_staffs = $this->listDirectStaffsOfUser($user);

        session()->put('listDirectStaffs', $direct_staffs);

        return $direct_staffs;
    }

    /**
     * @param User|int $user
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listStaffsOfUser($user)
    {
        $id = $user instanceof User ? $user->getId() : $user;

        /** @var ListUserResponse $response */
        $response = (new UserApi())->listStaffs($id);

        return collect($response->getData()->getUsers());
    }

    /**
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listStaffsOfCurrentUser()
    {
        if (session()->has('listStaffs')) {
            return session()->get('listStaffs');
        }

        /** @var User $user */
        $user = auth('id')->user();

        $staffs = $this->listStaffsOfUser($user);

        session()->put('listStaffs', $staffs);

        return $staffs;
    }

    /**
     * @param User|int $user
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listManagersOfUser($user)
    {
        $id = $user instanceof User ? $user->getId() : $user;

        /** @var ListUserResponse $response */
        $response = (new UserApi())->listManagers($id);

        return collect($response->getData()->getUsers());
    }

    /**
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listManagersOfCurrentUser()
    {
        if (session()->has('listManagers')) {
            return session()->get('listManagers');
        }

        /** @var User $user */
        $user = auth('id')->user();

        $managers = $this->listManagersOfUser($user);

        session()->put('listManagers', $managers);

        return $managers;
    }

    /**
     * @param User|int $user
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listDirectManagersOfUser($user)
    {
        $id = $user instanceof User ? $user->getId() : $user;

        /** @var ListUserResponse $response */
        $response = (new UserApi())->listDirectManagers($id);

        return collect($response->getData()->getUsers());
    }

    /**
     * @return Collection|mixed
     * @throws ApiException
     */
    public function listDirectManagersOfCurrentUser()
    {
        if (session()->has('listDirectManagers')) {
            return session()->get('listDirectManagers');
        }

        /** @var User $user */
        $user = auth('id')->user();

        $direct_managers = $this->listDirectManagersOfUser($user);

        session()->put('listDirectManagers', $direct_managers);

        return $direct_managers;
    }
}
