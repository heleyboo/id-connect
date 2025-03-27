<?php

namespace SonLeu\IDConnect\Models;

use SonLeu\IDConnect\Auth\Models\User as Authenticatable;
use SonLeu\IDConnect\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /** @var int */
    public $id;

    /** @var string */
    public $code;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var Position */
    public $position;

    /** @var self[] */
    public $staffs;

    /** @var self[] */
    public $managers;

    /** @var int $parent_id */
    public $parent_id;

    /** @var string $avatar */
    public $avatar;

    /** @var string $portrait */
    public $portrait;

    /** @var bool $is_active */
    public $is_active;

    /** @var string $telegram_id */
    public $telegram_id;

    /**
     * Array of property to type mappings. Used for (de)serialization
     * @var string[]
     */
    public static $typeMap = [
        'id' => 'integer',
        'code' => 'string',
        'name' => 'string',
        'email' => 'string',
        'position' => Position::class,
        'staffs' => User::class . '[]',
        'managers' => User::class . '[]',
        'avatar' => 'string',
        'portrait' => 'string',
        'is_active' => 'boolean',
        'telegram_id' => 'string',
    ];

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    public static $attributeMap = [
        'id' => 'id',
        'code' => 'code',
        'name' => 'name',
        'email' => 'email',
        'position' => 'position',
        'staffs' => User::class . '[]',
        'managers' => User::class . '[]',
        'avatar' => 'avatar',
        'portrait' => 'portrait',
        'is_active' => 'is_active',
        'telegram_id' => 'telegram_id',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    public static $setters = [
        'id' => 'setId',
        'code' => 'setCode',
        'name' => 'setName',
        'email' => 'setEmail',
        'position' => 'setPosition',
        'staffs' => 'setStaffs',
        'managers' => 'setManagers',
        'avatar' => 'setAvatar',
        'portrait' => 'setPortrait',
        'is_active' => 'setIsActive',
        'telegram_id' => 'setTelegramId',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    public static $getters = [
        'id' => 'getId',
        'code' => 'getCode',
        'name' => 'getName',
        'email' => 'getEmail',
        'position' => 'getPosition',
        'staffs' => 'getStaffs',
        'managers' => 'getManagers',
        'avatar' => 'getAvatar',
        'portrait' => 'getPortrait',
        'is_active' => 'getIsActive',
        'telegram_id' => 'getTelegramId',
    ];

    /**
     * User constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        unset($this->rememberTokenName);

        $this->id = isset($data['id']) ? $data['id'] : null;
        $this->code = isset($data['code']) ? $data['code'] : null;
        $this->name = isset($data['name']) ? $data['name'] : null;
        $this->email = isset($data['email']) ? $data['email'] : null;
        $this->position = isset($data['position']) ? $data['position'] : null;
        $this->staffs = isset($data['staffs']) ? $data['staffs'] : null;
        $this->managers = isset($data['managers']) ? $data['managers'] : null;
        $this->avatar = isset($data['avatar']) ? $data['avatar'] : null;
        $this->portrait = isset($data['portrait']) ? $data['portrait'] : null;
        $this->is_active = isset($data['is_active']) ? $data['is_active'] : null;
        $this->telegram_id = isset($data['telegram_id']) ? $data['telegram_id'] : null;

        if (config('id_connect.models.position')) {
            static::$typeMap['position'] = config('id_connect.models.position');
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return User
     */
    public function setCode(string $code): User
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return Position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param Position $position
     * @return User
     */
    public function setPosition($position): User
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return User[]
     */
    public function getStaffs()
    {
        return $this->staffs;
    }

    /**
     * @param User[] $staffs
     * @return User
     */
    public function setStaffs(array $staffs): User
    {
        $this->staffs = $staffs;
        return $this;
    }

    /**
     * @return User[]
     */
    public function getManagers()
    {
        return $this->managers;
    }

    /**
     * @param User[] $managers
     * @return User
     */
    public function setManagers(array $managers): User
    {
        $this->managers = $managers;
        return $this;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return User
     */
    public function setAvatar(string $avatar): User
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return string
     */
    public function getPortrait()
    {
        return $this->avatar;
    }

    /**
     * @param string $portrait
     * @return User
     */
    public function setPortrait(string $portrait): User
    {
        $this->portrait = $portrait;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * @param bool $is_active
     * @return User
     */
    public function setIsActive($is_active): User
    {
        $this->is_active = $is_active;
        return $this;
    }

    /**
     * @return string
     */
    public function getTelegramId()
    {
        return $this->telegram_id;
    }

    /**
     * @param string $telegram_id
     * @return User
     */
    public function setTelegramId($telegram_id): User
    {
        $this->telegram_id = $telegram_id;
        return $this;
    }
}
