<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branches;
use App\Company;
use App\BranchQuestions;
use App\Questions;
use App\Reviews;
use App\ReviewAnswer;
class AdminBranchController extends Controller
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
    public function index()
    {
        $this->authorize('roleview', auth()->user()->type->roles->company_branch_view);
        if(auth()->user()->company === null)
        {
            $branches = Branches::with('company')->get();
        }else{
            $branches = Branches::where('company_id',auth()->user()->company->company_id)->with('company')->get();
        }
        
        return view('panel.branches.index',['branches'=>$branches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->company_branch_create);
        $companies = Company::all();
        return view('panel.branches.create',['companies'    =>  $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->company_branch_create);
        $rules  =   [
                        'branch_name'       =>  'required|string|max:100',
                        'branch_code'       =>  'required|numeric|digits:6|unique:branches,branch_code',
                    ];
        $names  =   [
                        'branch_name'       =>  'Branch Name',
                        'branch_code'       =>  'Branch Code',
                        'company_id'        =>  'Company',
                    ];
        if($request->has('company_id')  && $request->company_id)
        {
            $rules['company_id']                = 'required|integer|exists:companies,company_id';
        }
        $data   =   $this->validate($request,$rules,[],$names);
        if(auth()->user()->company !== null)
        {
            $data['company_id'] = auth()->user()->company->company_id;
        }
        $data['branch_made_by'] =   auth()->user()->admin_name;
        $branch =   Branches::create($data);
        return redirect()->route('branch.index')->with('success','Branch added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('roleview', auth()->user()->type->roles->company_branch_view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('roleupdate', auth()->user()->type->roles->company_branch_update);
        $id         = decrypt($id);
        $branch     =   Branches::findOrfail($id);
        $companies  =   Company::all();
        return view('panel.branches.edit',['companies'    =>  $companies,'branch'=>$branch]);
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
        $this->authorize('roleupdate', auth()->user()->type->roles->company_branch_update);
        $id     = decrypt($id);
        $rules  =   [
                        'branch_name'       =>  'required|string|max:100',
                        'branch_code'       =>  "required|numeric|digits:6|unique:branches,branch_code,$id,branch_id",
                    ];
        $names  =   [
                        'branch_name'       =>  'Branch Name',
                        'branch_code'       =>  'Branch Code',
                        'company_id'        =>  'Company',
                    ];
        if($request->has('company_id')  && $request->company_id)
        {
            $rules['company_id']                = 'required|integer|exists:companies,company_id';
        }
        $data   =   $this->validate($request,$rules,[],$names);
        if(auth()->user()->company !== null)
        {
            $data['company_id'] = auth()->user()->company->company_id;
        }
        $branch =   Branches::findOrfail($id)->update($data);
        return redirect()->route('branch.index')->with('success','Branch Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('roledelete', auth()->user()->type->roles->company_branch_delete);
        $id     = decrypt($id);
        $branch             =   Branches::findOrfail($id);
        $branchQuestion     =   BranchQuestions::where('branch_id',$branch->branch_id)->get();
        foreach ($branchQuestion as $question) {
            $question->delete();
        }
        $answers            =  ReviewAnswer::where('branch_id',$branch->branch_id)->get();
        foreach ($answers as $answer) {
            $answer->delete();
        }
        $reviews            =  Reviews::where('branch_id',$branch->branch_id)->get();
        foreach ($reviews as $review) {
            $review->delete();
        }
        $branch->delete();
        return redirect()->route('branch.index')->with('success',' Branch Deleted successfully');
    }
    public function assignQuestions ($id)
    {
        $this->authorize('roleview', auth()->user()->type->roles->company_branch_question_view);
        $id                 =   decrypt($id);
        $branch             =   Branches::findOrfail($id);
        $branchQuestion     =   BranchQuestions::where('branch_id',$branch->branch_id)->where('company_id',$branch->company_id)->select('question_id')->get()->toArray();
        $questions          =   Questions::where('company_id',$branch->company_id)->whereIn('question_id',$branchQuestion)->get();
       
        return view('panel.branches.question.index',['branch'=>$branch,'questions'=>$questions]);
    }
    public function createAssign ($id)
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->company_branch_question_assign);
        $id                 = decrypt($id);
        $branch             =   Branches::findOrfail($id);
        $branchQuestion     =   BranchQuestions::where('branch_id',$branch->branch_id)->where('company_id',$branch->company_id)->select('question_id')->get()->toArray();
        $questions          =   Questions::where('company_id',$branch->company_id)->whereNotIn('question_id',$branchQuestion)->get();
        return view('panel.branches.question.create',['branch'=>$branch,'questions'=>$questions]);
    }
    public function storeAssign (Request $request,$id)
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->company_branch_question_assign);
        $id                 = decrypt($id);
        $branch             =   Branches::findOrfail($id);
        $rules              =   [
                                    'questions'       =>   'required',
                                    'questions.*'     =>   'required|integer|exists:questions,question_id',
                                ];
        $names              =   [
                                    'questions.*'     =>   'Questions',
                                ];
        $data               =   $this->validate($request,$rules,[],$names);
       
        for($i = 0; $i < count($request->questions) ;   $i++ )
        {
            $branchQuestion     =   BranchQuestions::create([
                                                                'branch_id'       =>    $branch->branch_id,
                                                                'company_id'      =>    $branch->company_id,
                                                                'question_id'     =>    $data['questions'][$i],  
                                                            ]);
        }
        return redirect()->route('branch.assign.index',encrypt($branch->branch_id))->with('success','New Questions Assigned To Branch successfully');
    }
    public function deleteAssign($branch_id,$question_id)
    {
        $this->authorize('roledelete', auth()->user()->type->roles->company_branch_question_delete);
        $branch_id          =   decrypt($branch_id);
        $question_id        =   decrypt($question_id);
        $branch             =   Branches::findOrfail($branch_id);
        $branchQuestion     =   BranchQuestions::where('branch_id',$branch_id)->where('company_id',$branch->company_id)->where('question_id',$question_id)->delete();
        return redirect()->route('branch.assign.index',encrypt($branch->branch_id))->with('success','Questions unassigned To Branch successfully');
    }
}
