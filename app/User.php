<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = 'users';
    public $timestamps = false;
    protected $primaryKey = "id_user";
}
