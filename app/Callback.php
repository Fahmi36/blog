<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
	protected $table = "banks";
	public $timestamps = false;
	protected $primaryKey = "id_bank";
}
