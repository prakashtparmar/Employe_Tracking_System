<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;


class Admin extends Authenticatable
{
    protected $guard = 'admin';
}
