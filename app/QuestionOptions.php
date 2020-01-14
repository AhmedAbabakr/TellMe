<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Crypt;
class QuestionOptions extends Model
{
    protected $table		=	'question_options';
    protected $primaryKey	=	'option_id';
    protected $fillable		=	[
    								'question_id','option_text_en','option_text_ar','option_image','option_type','option_made_by'
    							];
	protected $casts		=	[
									'question_id'			=>	'integer',
									'option_type'			=>	'integer',
									// 'option_made_by'		=>	'integer',
								];
	public function question()
    {
     	return $this->belongsTo('App\Questions','question_id');
    }
    
}
