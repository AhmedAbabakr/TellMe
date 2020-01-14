<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\Hashidable;
class Admin_type extends Model
{
	 use Hashidable;
    protected $table 		=	'admin_types';
    protected $primaryKey	=	'admin_type_id';
    protected $fillable		=	['admin_type_name','admin_type_is_active','admin_type_enable_to_company'];
    protected $casts		=	[
                                    'admin_type_is_active'	         =>	'integer',
                                    'admin_type_enable_to_company'   =>  'integer'
                                ];
    public function user()
    {
        return $this->hasMany('App\Admins','admin_type','admin_type_id');
    }
    public function roles()
    {
        return $this->hasOne('App\Manage_role','admin_type','admin_type_id');
    }
}
