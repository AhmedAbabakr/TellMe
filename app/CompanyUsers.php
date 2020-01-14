<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyUsers extends Model
{
    protected	$table			=	'company_users';
    protected	$primaryKey		=	'company_user_id';
    protected	$fillable		=	['company_id','admin_id'];
    protected	$casts			=	[
    									'company_id'		=>	'integer',
    									'admin_id'			=>	'integer',
    								];
	public 	function user()
	{
		return $this->belongsTo('App\Admins', 'admin_id', 'admin_id');
	}
	public 	function company()
	{
		return $this->belongsTo('App\Company', 'company_id', 'company_id');
	}
}
