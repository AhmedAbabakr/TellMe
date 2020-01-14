<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\QuestionOptions;
use File;
class AdminOptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $this->authorize('roleview', auth()->user()->type->roles->question_options_view);
        $id         = decrypt($id);
        $question   = Questions::findOrFail($id);
        $options    = QuestionOptions::where('question_id',$question->question_id)->get();
        return view('panel.option.index',['question'=>$question,'options'=>$options]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('rolecreate', auth()->user()->type->roles->question_options_create);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->question_options_create);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('roleview', auth()->user()->type->roles->question_options_view);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($question_id,$option_id)
    {
        $this->authorize('roleupdate', auth()->user()->type->roles->question_options_update);
        $question_id        = decrypt($question_id);
        $option_id          = decrypt($option_id);
        $question   = Questions::findOrFail($question_id);
        $option     = QuestionOptions::where('question_id',$question->question_id)->where('option_id',$option_id)->firstOrFail();
        return view('panel.option.edit',['question'=>$question,'option'=>$option]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $question_id,$option_id)
    {
        $this->authorize('roleupdate', auth()->user()->type->roles->question_options_update);
        $question_id        = decrypt($question_id);
        $option_id          = decrypt($option_id);
        $question   = Questions::findOrFail($question_id);
        $option     = QuestionOptions::where('question_id',$question->question_id)->where('option_id',$option_id)->firstOrFail();
        $rules      = [
                            'option_text_en'    =>  'required|string',
                            'option_text_ar'    =>  'required|string',
                      ];
        if($request->has('option_image') && $request->option_image )
        {
            $rules['option_image']  =   'required|image';
        }
        $names      = [
                            'option_text_en'    =>  'Option English Text',
                            'option_text_ar'    =>  'Option Arabic Text',
                            'option_image'      =>  'Option Image',
                      ];
        $data       = $this->validate($request,$rules,[],$names);
        if (!file_exists('images/options/')) {
                    mkdir('images/options/', 0777, true);
        }
        if($request->hasFile('option_image') ){
            $image = $request->option_image;
            $fileName = time().'-option-'.$image->getClientOriginalName();
            $image->move('images/options/', $fileName);
            $uploadImage = 'images/options/'.$fileName;
            $data['option_image']  = $uploadImage;
            File::delete($option->option_image);
        }
        $option->update($data);
        return redirect()->route('options.index',encrypt($question->question_id))->with('success','Option Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('roledelete', auth()->user()->type->roles->question_options_delete);
    }
}
