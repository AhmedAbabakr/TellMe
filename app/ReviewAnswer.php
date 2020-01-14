<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewAnswer extends Model
{
    protected $table		=	'review_answers';
    protected $primaryKey	=	'review_answer_id';
    protected $fillable		=	[
    								'branch_id','question_id','company_id','review_id','option_id','option_text'
    							];
	protected $casts		=	[
									'branch_id'				=>	'integer',
									'question_id'			=>	'integer',
									'company_id'			=>	'integer',
									'review_id'				=>	'integer',
									'option_id'				=>	'integer',
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
		return $this->belongsTo('App\Questions', 'question_id', 'question_id');
	}

	public function review()
	{
		return $this->belongsTo('App\Reviews', 'review_id', 'review_id');
	}
	public function options()
    {
        return $this->belongsTo('App\QuestionOptions','option_id');
    }
    
}
