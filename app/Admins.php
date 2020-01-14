<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admins extends Authenticatable
{
    protected $table		=	'admins';
    protected $primaryKey	=	'admin_id';
    protected $fillable		=	[
    								'admin_name',
    								'admin_username',
    								'admin_email',
    								'email_verified_at',
    								'admin_password',
    								'admin_status',
    								'admin_type',
    								'remember_token'
    							];
    protected $hidden 		= [
    	'admin_password', 'remember_token','created_at','updated_at'
	];
	protected $casts		=	[
									'admin_type'	=>	'integer',
									'admin_status'	=>	'integer',
								];							
	public function getAuthPassword()
    {
     	return $this->admin_password;
    }
    public function type()
    {
        return $this->belongsTo('App\Admin_type','admin_type','admin_type_id')->with('roles');
    }
    public function company(){
        return $this->hasOne('App\CompanyUsers', 'admin_id', 'admin_id');
    }
}
