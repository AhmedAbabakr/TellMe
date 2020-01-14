<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reviews;
use App\ReviewAnswer;
use App\BranchQuestions;
use App\Questions;
use App\QuestionOptions;
class GuestController extends Controller
{
	protected $options = [
        'single_choice'     =>  0,
        'multi_choice'      =>  1,
        'text'              =>  2,
        'image'             =>  3,
        'star'              =>  4,
        'smile'             =>  5,
    ];
    public function index($id)
    {
    	$id  = decrypt($id);
    	$review = Reviews::where('review_case',0)->where('review_id',$id)->firstOrFail();
    	$question = BranchQuestions::where('branch_id',$review->branch_id)->get();
    	return view('guest.index',['review'=>$review,'questions'=>$question]);
    }
    public function store(Request $request,$id)
    {
    	$id  = decrypt($id);
    	$review = Reviews::where('review_case',0)->where('review_id',$id)->firstOrFail();
    	for($i = 0 ; $i < count($request->all()) ; $i++)
    	{
    		
    		
    		if(isset($request->question_id[$i]))
    		{
    			$data['question_id'] = $request->question_id[$i];
    		}else{
    			$data['question_id'] = null;
    		}
    		if(isset($request->question_type[$i]))
    		{
    			$data['question_type'] = $request->question_type[$i];
    			
    		}else{
    			$data['question_type'] = null;
    		}
    		$question = Questions::where('question_id',$data['question_id'])->where('question_type',$data['question_type'])->firstOrFail();
    		if($question !==null)
    		{
    			if($question->question_type == $this->options['single_choice'] || $question->question_type == $this->options['multi_choice'] || $question->question_type == $this->options['image'])
    			foreach($request->option_id[$i] as $option )
    			{
    				$option = QuestionOptions::findOrFail($option);
    			}
    		}
    	}
    	for($i = 0 ; $i < count($request->all()) ; $i++)
    	{
    		if(isset($request->question_id[$i]))
    		{
    			$data['question_id'] = $request->question_id[$i];
    		}else{
    			$data['question_id'] = null;
    		}
    		if(isset($request->question_type[$i]))
    		{
    			$data['question_type'] = $request->question_type[$i];
    			
    		}else{
    			$data['question_type'] = null;
    		}
    		$question = Questions::where('question_id',$data['question_id'])->where('question_type',$data['question_type'])->firstOrFail();
    		if($question !==null)
    		{
    			if(isset($request->option_id[$i]))
    			{
	    			if(count($request->option_id[$i]) > 0)
	                {
	                    
	                    foreach($request->option_id[$i] as $option_id)
	                    {
	                       
	                        $answer = ReviewAnswer::create([
	                            'branch_id'                     =>  $review->branch_id,
	                            'company_id'                    =>  $review->company_id,
	                            'review_id'                     =>  $review->review_id, 
	                            'question_id'                   =>  $data['question_id'][0], 
	                            'option_text'                   =>  null, 
	                            'option_id'                     =>  $option_id, 
	                        ]);

	                    }
	                }
	            }else
	            {
	                	if(isset($request->option_text[$i]))
			    		{
	                        $answer = ReviewAnswer::create([
	                            'branch_id'                     =>  $review->branch_id,
	                            'company_id'                    =>  $review->company_id,
	                            'review_id'                     =>  $review->review_id, 
	                            'question_id'                   =>  $data['question_id'][0], 
	                            'option_text'                   =>  $request->option_text[$i], 
	                            'option_id'                     =>  null, 
	                        ]);
	                    }
	              
	            }
    		}
		}
		$review->update(['review_case'=> 1 ]);
		return view('guest.thanks');
    }
}
