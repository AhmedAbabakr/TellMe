<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Questions;
use App\QuestionsOption;
use App\BranchQuestions;
use App\Reviews;
use App\ReviewAnswer;
use Validator;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\GenralResource as GlobalResource;
class IndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    protected $options = [
        'single_choice'     =>  0,
        'multi_choice'      =>  1,
        'text'              =>  2,
        'image'             =>  3,
        'star'              =>  4,
        'smile'             =>  5,
    ];

    public function getQuestion()
    {
    	$questions = BranchQuestions::where('branch_id',auth('api')->user()->branch_id)->where('company_id',auth('api')->user()->company_id)->with('question')->get();
        if($questions->count() > 0 )
        {
            $questions = new GlobalResource($questions);
            $responseData = array('success'=>'1', 'data'=>$questions, 'message'=>"Get All Questions.");
            return $responseData;
        }else{
            $responseData = array('success'=>'0', 'data'=>json_decode("{}"), 'message'=>"No Questions Assigned.");
            return $responseData;
        }
    }
    public function makeReview(Request $request)
    {
        $rules = [
            'payload'                   =>  'required|json',
            'customer_name'             =>  'required|string',
            'customer_email'            =>  'nullable|email',
            'customer_phone'            =>  'nullable|string',
            'customer_note'             =>  'nullable|string',
            'customer_contact_method'   =>  'required|string'
        ];
        $names = [
            'payload'                   =>  'Payload',
            'customer_name'             =>  'Customer Name',
            'customer_email'            =>  'Customer Email',
            'customer_phone'            =>  'Customer Phone',
            'customer_note'             =>  'Customer Note',
            'customer_contact_method'   =>  'Customer Contact Method',
        ];
        $validate=Validator::make($request->all(),$rules,[],$names);
        if($validate->fails())
        {
            $errorString = implode(",",$validate->messages()->all());
            $responseData = array('success'=>'0', 'data'=>json_decode("{}"), 'message'=> $errorString);
            return $responseData;
        }else{
            $data    = [
                            'customer_name'                 =>  $request->customer_name,
                            'customer_note'                 =>  $request->customer_note,
                            'customer_phone'                =>  $request->customer_phone,
                            'customer_email'                =>  $request->customer_email,
                            'customer_contact_method'       =>  $request->customer_contact_method,
                            'branch_id'                     =>  auth('api')->user()->branch_id,
                            'company_id'                    =>  auth('api')->user()->company_id,
                       ];
            
            $payload = json_decode($request->payload, true);
            for($i = 0 ;$i < count($payload); $i++)
            {

                $rule = [
                    'question_id'       =>  'required|integer|exists:questions,question_id',
                    'question_type'     =>  'required|integer|between:0,5',
                ];
                $names = [
                    'question_id'       =>  'Question',
                    'question_type'     =>  'Question Type',
                    'option_id.*'       =>  'Option ID',
                    'option_text'       =>  'Option Text',
                ];
                if( array_key_exists('question_type', $payload[$i]) )
                {
                    if($payload[$i]['question_type'] == $this->options['single_choice'] )
                    {
                        $rule['option_id']              = 'required|min:1|max:1';
                        $rule['option_id.*']            = 'required|integer|exists:question_options,option_id';
                        $rule['option_text']            = 'nullable|string';
                    }elseif($payload[$i]['question_type'] == $this->options['multi_choice']  )
                    {
                        $rule['option_id']              = 'required|min:1|max:3';
                        $rule['option_id.*']            = 'required|integer|exists:question_options,option_id';
                        $rule['option_text']            = 'nullable|string';
                    }elseif($payload[$i]['question_type'] == $this->options['image'])
                    {
                        $rule['option_id']              = 'required|min:1|max:1';
                        $rule['option_id.*']            = 'required|integer|exists:question_options,option_id';
                        $rule['option_text']            = 'nullable|string';
                    }elseif ($payload[$i]['question_type'] == $this->options['text'] || $payload[$i]['question_type'] == $this->options['star'] || $payload[$i]['question_type'] == $this->options['smile'] ) {
                         $rule['option_text']         = 'required|string';
                    }
                    
                }
                $validate=Validator::make($payload[$i],$rule,[],$names);
                if($validate->fails())
                {
                    $errorString = implode(",",$validate->messages()->all());
                    $responseData = array('success'=>'0', 'data'=>json_decode("{}"), 'message'=> $errorString , 'i'=>$i);
                    return $responseData;
                }
            }
            $review         = Reviews::create($data);
            for($i = 0 ; $i < count($payload) ; $i++)
            {
                if(count($payload[$i]['option_id']) > 0)
                {
                    
                    foreach($payload[$i]['option_id'] as $option_id)
                    {
                        
                        $answer = ReviewAnswer::create([
                            'branch_id'                     =>  auth('api')->user()->branch_id,
                            'company_id'                    =>  auth('api')->user()->company_id,
                            'review_id'                     =>  $review->review_id, 
                            'question_id'                   =>  $payload[$i]['question_id'], 
                            'option_text'                   =>  $payload[$i]['option_text'], 
                            'option_id'                     =>  $option_id, 
                        ]);

                    }
                }else{
                        $answer = ReviewAnswer::create([
                            'branch_id'                     =>  auth('api')->user()->branch_id,
                            'company_id'                    =>  auth('api')->user()->company_id,
                            'review_id'                     =>  $review->review_id, 
                            'question_id'                   =>  $payload[$i]['question_id'], 
                            'option_text'                   =>  $payload[$i]['option_text'], 
                            'option_id'                     =>  null, 
                        ]);
                }
            }
            
            $responseData = array('success'=>'1', 'data'=>json_decode("{}"), 'message'=>"Review Created Successfully.");
            return $responseData; 
        }
        
    }
    
}
