<?php

namespace SonLeu\IDConnect\Auth\Models;

use SonLeu\IDConnect\AbstractModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends AbstractModel implements AuthenticatableContract
{
    use Authenticatable;
}
