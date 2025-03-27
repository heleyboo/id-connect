<?php

namespace SonLeu\IDConnect\Models;

use SonLeu\IDConnect\AbstractModel;

class ListUserData extends AbstractModel
{
    /** @var array */
    protected $users;

    protected static $typeMap = [
        'users' => User::class . '[]',
    ];

    protected static $attributeMap = [
        'users' => 'users'
    ];

    protected static $getters = [
        'users' => 'getUsers'
    ];

    protected static $setters = [
        'users' => 'setUsers'
    ];

    /**
     * ListUserData constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->users = isset($data['users']) ? $data['users'] : null;
        }

        if (config('id_connect.models.user')) {
            static::$typeMap['users'] = config('id_connect.models.user') . '[]';
        }
    }

    /**
     * @return User[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param array $users
     * @return ListUserData
     */
    public function setUsers($users)
    {
        $this->users = $users;
        return $this;
    }
}
