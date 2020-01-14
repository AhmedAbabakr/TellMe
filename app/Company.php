<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table		=	'companies';
    protected $primaryKey	=	'company_id';
    protected $fillable		=	[
    								'company_name_en',
    								'company_name_ar',
    								'company_email',
    								'company_username',
    								'company_password',
    								'company_address_en',
									'company_address_ar',
    								'company_pin',
    								'company_phone',
    								'company_logo',
    								'company_background',
    								'company_color',
								];
    protected   $hidden    =    [
                                    'company_username', 'created_at','updated_at','company_password','company_id'
                                ];
    public function admin()
    {
        return $this->hasMany('App\CompanyUsers','company_id','company_id');
    }

    public function branch()
    {
        return $this->hasMany('App\Branches','company_id','company_id');
    }
    public function reviews()
    {
        return $this->hasMany('App\Reviews','company_id','company_id');
    }

}
