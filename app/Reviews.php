<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected	$table			=	'reviews';
    protected	$primaryKey		=	'review_id';
    protected	$fillable		=	['branch_id','company_id','customer_name','customer_email','customer_phone','customer_note','customer_contact_method','review_token','review_case'];
    protected	$casts			=	[
    									'branch_id'				=>	'integer',
    									'company_id'			=>	'integer',
    								];
    protected   $hidden     =   [
                                    'review_token',
                                ];
	public function company(){
		return $this->belongsTo('App\Company', 'company_id', 'company_id');
	}

	public function branch(){
		return $this->belongsTo('App\Branches', 'branch_id', 'branch_id');
	}
    public function answers()
    {
        return $this->hasMany('App\ReviewAnswer','review_id');
    }

}
