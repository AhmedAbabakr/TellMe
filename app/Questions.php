<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected	$table			=	'questions';
    protected	$primaryKey		=	'question_id';
    protected	$fillable		=	['question_content_en','question_content_ar','question_type','company_id','question_made_by'];
    protected	$casts			=	[
    									'question_type'				=>	'integer',
    									'company_id'			    =>	'integer',
    									// 'question_made_by'			=>	'integer',
    								];
	public function company(){
		return $this->belongsTo('App\Company', 'company_id', 'company_id');
	}
	// public 	function user()
	// {
	// 	return $this->belongsTo('App\Admins','question_made_by','admin_id');
	// }
	public function options()
    {
        return $this->hasMany('App\QuestionOptions','question_id');
    }
}
