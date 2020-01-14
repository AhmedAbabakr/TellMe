<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchQuestions extends Model
{
    protected $table		=	'branch_questions';
    protected $primaryKey	=	'branch_question_id';
    protected $fillable		=	[
    								'branch_id','question_id','company_id'
    							];
	protected $casts		=	[
									'branch_id'			=>	'integer',
									'question_id'			=>	'integer',
									'company_id'		=>	'integer',
								];
	protected 	$hidden		=   [
							        'branch_id', 'created_at','updated_at','company_id',
							    ];
	public function company()
	{
		return $this->belongsTo('App\Company', 'company_id', 'company_id');
	}

	public function branch()
	{
		return $this->belongsTo('App\Branches', 'branch_id', 'branch_id');
	}

	public function question()
	{
		return $this->belongsTo('App\Questions', 'question_id', 'question_id')->with('options');
	}
}
