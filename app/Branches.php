<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Traits\Hashidable;
class Branches extends Authenticatable implements JWTSubject
{
    use Hashidable;
    protected	$table			=	'branches';
    protected	$primaryKey		=	'branch_id';
    protected	$fillable		=	['company_id','branch_name','branch_code','branch_made_by'];
    protected	$casts			=	[
    									'company_id'				=>	'integer',
    									// 'branch_made_by'			=>	'integer',
    								];
	protected 	$hidden 		=   [
								        'branch_made_by', 'created_at','updated_at','company_id'
								    ];
	public 	function company()
	{
		return $this->belongsTo('App\Company', 'company_id', 'company_id');
	}
	// public 	function user()
	// {
	// 	return $this->belongsTo('App\Admins','branch_made_by','admin_id');
	// }
	public function reviews()
    {
        return $this->hasMany('App\Reviews','branch_id','branch_id');
    }
	public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
