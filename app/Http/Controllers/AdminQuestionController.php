<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\QuestionOptions;
use App\Reviews;
use App\ReviewAnswer;
use App\BranchQuestions;
use App\Company;
use File;
class AdminQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }
    
    protected $options = [
        'single_choice'     =>  0,
        'multi_choice'      =>  1,
        'text'              =>  2,
        'image'             =>  3,
        'star'              =>  4,
        'smile'             =>  5,
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('roleview', auth()->user()->type->roles->question_view);
        if(auth()->user()->company === null)
        {
            $questions = Questions::with('company')->get();
        }else{
            $questions = Questions::where('company_id',auth()->user()->company->company_id)->with('company')->get();
        }
        return view('panel.question.index',['questions'=>$questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->question_create);
        $companies = Company::all();
        return view('panel.question.create',['companies'    =>  $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->question_create);
        $rules = [
            'question_content_en'      =>  'required|string|max:255',
            'question_content_ar'      =>  'required|string|max:255',
            'question_type'            =>  'required|integer|between:0,5',
        ];
        $names = [
            'question_content_en'      =>  'Question English Content',
            'question_content_ar'      =>  'Question Arabic Content',
            'question_score'           =>  'Question Score',
            'question_type'            =>  'Question Type',
            'option_image.*'           =>  'Option Image',
            'option_image'             =>  'Option Image',
            'option_text_en.*'         =>  'Option English Text',
            'option_text_ar.*'         =>  'Option Arabic Text',
            'option_correct'           =>  'Option Answer Status',
        ];
        if($request->has('company_id')  && $request->company_id)
        {
            $rules['company_id']                = 'required|integer|exists:companies,company_id';
        }
        if($request->has('question_type')  )
        {

            if($request->question_type == $this->options['single_choice'] )
            {
                $rules['option_text_en']          = 'required|min:3|max:3';
                $rules['option_text_ar']          = 'required|min:3|max:3';
                $rules['option_text_en.*']         = 'required|string';
                $rules['option_text_ar.*']         = 'required|string';
            }elseif($request->question_type == $this->options['multi_choice']  )
            {
                $rules['option_text_en']          = 'required|min:3|max:3';
                $rules['option_text_ar']          = 'required|min:3|max:3';  
                $rules['option_text_en.*']         = 'required|string';
                $rules['option_text_ar.*']         = 'required|string';
            }elseif($request->question_type == $this->options['image'])
            {
                $rules['option_text_en']            = 'required|min:4|max:4';
                $rules['option_text_ar']            = 'required|min:4|max:4';
                $rules['option_text_en.*']          = 'required|string';
                $rules['option_text_ar.*']          = 'required|string';
                $rules['option_image']              = 'required|min:4|max:4';
                $rules['option_image.*']            = 'required|image';
            }elseif ($request->question_type == $this->options['text'] || $request->question_type == $this->options['star'] || $request->question_type == $this->options['smile'] ) {
                 $rules['option_text_en.*']         = 'nullable|string';
                 $rules['option_text_ar.*']         = 'nullable|string';
            }
        }
        $data = $this->validate($request,$rules,[],$names);
        if($request->has('option_text_en') && $request->option_text_en )
        {
            $option_text_en= $request->option_text_en;
            $option_text_ar= $request->option_text_ar;
        }else{
            $option_text_en = [];
            $option_text_ar = [];
        }
        if(auth()->user()->company !== null)
        {
            $data['company_id'] = auth()->user()->company->company_id;
        }
        $data['question_made_by'] =   auth()->user()->admin_name;
        $question = Questions::create($data);
        if (!file_exists('images/options/')) {
                    mkdir('images/options/', 0777, true);
        }
        for ($i=0; $i < count($option_text_en) ; $i++) { 
          $info['option_text_en']   =   $option_text_en[$i];
          $info['option_text_ar']   =   $option_text_ar[$i];
          $info['question_id']      =   $question->question_id;
          $info['option_type']      =   $question->question_type;
          $info['option_made_by']   =   $question->question_made_by;
            
          if($request->hasFile('option_image') ){
                
                $image = $request->option_image[$i];
                $fileName = time().'-option-'.$image->getClientOriginalName();
                $image->move('images/options/', $fileName);
                $uploadImage = 'images/options/'.$fileName;
                $info['option_image']  = $uploadImage;
            }
            
          $option = QuestionOptions::create($info);

       }
       return redirect()->route('question.index')->with('success','New Question Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('roleview', auth()->user()->type->roles->question_view);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $this->authorize('roleupdate', auth()->user()->type->roles->question_update);
        $id         = decrypt($id);
        $companies  = Company::all();
        $question   = Questions::with('company','options')->findOrFail($id);
        return view('panel.question.edit',['question'=>$question,'companies'=>$companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('roleupdate', auth()->user()->type->roles->question_update);
        $id         = decrypt($id);
        $question   = Questions::findOrFail($id);
        $rules = [
            'question_content_en'      =>  'required|string|max:255',
            'question_content_ar'      =>  'required|string|max:255',
        ];
        $names = [
            'question_content_en'      =>  'Question English Content',
            'question_content_ar'      =>  'Question Arabic Content',
        ];
         if($request->has('company_id')  && $request->company_id)
        {
            $rules['company_id']                = 'required|integer|exists:companies,company_id';
        }
       
       
        $data = $this->validate($request,$rules,[],$names);
        
        $question->update($data);
        
       return redirect()->route('question.index')->with('success','Question Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('roledelete', auth()->user()->type->roles->question_delete);
         $id         = decrypt($id);
        $question   = Questions::findOrFail($id);
        $answers    = ReviewAnswer::where('question_id',$question->question_id)->get();

        foreach ($answers as $answer) {
          $answer->delete();
        } 
        $branchQuestion = BranchQuestions::where('question_id',$question->question_id)->get();
        foreach ($branchQuestion as $branch) {
          $branch->delete();
        } 
        $options = QuestionOptions::where('question_id',$question->question_id)->get();
        foreach ($options as $option) {
          if($question->question_type === 3 )
          {
               File::delete($option->option_image);
          }
          $option->delete();
        }
        $question->delete(); 
        return redirect()->route('question.index')->with('success','Question Deleted Successfully');

    }
    public function type_view(Request $request)
   {
        if($request->ajax())
        {
            if($request->value == $this->options['single_choice'] || $request->value == $this->options['multi_choice'])
            {
                $html = view('panel.includes.single_type');
                echo $html;
            }elseif($request->value == $this->options['image']){
                $html = view('panel.includes.image_type');
                echo $html;

            }else{

                echo null;
            }
        }else{
            return view('errors.404');
        }

   }
}
