<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
	public $table = 'topups';
	public $timestamps = false;
	protected $primaryKey = "id_topup";
	public function setPending()
	{
		$this->attributes['status'] = 'Pending';
		self::save();
	}

    /**
     * Set status to Success
     *
     * @return void
     */
    public function setSuccess()
    {
    	$this->attributes['status'] = 'Sukses';
    	self::save();
    }

    /**
     * Set status to Failed
     *
     * @return void
     */
    public function setFailed()
    {
    	$this->attributes['status'] = 'Gagal';
    	self::save();
    }

    /**
     * Set status to Expired
     *
     * @return void
     */
    public function setExpired()
    {
    	$this->attributes['status'] = 'Kadaluarsa';
    	self::save();
    }
}
