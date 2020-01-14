<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admins;
use App\Company;
use App\CompanyUsers;
use App\Branches;
use App\BranchQuestions;
use App\Questions;
use App\QuestionOptions;
use App\ReviewAnswer;
use App\Reviews;
use File;
class AdminCompanyController extends Controller
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
        $this->authorize('roleview', auth()->user()->type->roles->company_view);
        $companies = Company::all();
        return view('panel.company.index',['companies'  =>    $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->company_create);
        return view('panel.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->company_create);
        $rules = [
            'company_name_en'               =>  'required|string|max:100',
            'company_name_ar'               =>  'required|string|max:100',
            'company_username'              =>  'required|string|max:50|unique:admins,admin_username',
            'company_email'                 =>  'nullable|string|email|max:255|unique:admins,admin_email',
            'company_password'              =>  'required|string|min:8|confirmed',
            'company_logo'                  =>  'required|image|mimes:jpeg,jpg,png,bmp,gif',
            'company_color'                 =>  'required|string',
            'company_background'            =>  'nullable|image|mimes:jpeg,jpg,png,bmp,gif',
            'company_address_en'            =>  'nullable|string',
            'company_address_ar'            =>  'nullable|string',
            'company_phone'                 =>  'nullable|numeric',
        ];
        $names = [
            'company_name_en'               =>  'Company Admin Name English',
            'company_name_ar'               =>  'Company Admin Name Arabic',
            'company_username'              =>  'Company Admin Username',
            'company_email'                 =>  'Company Admin Email',
            'company_password'              =>  'Company Admin Password',
            'company_logo'                  =>  'Company Logo',
            'company_color'                 =>  'Company App Background Color',
            'company_background'            =>  'Company Background',
            'company_address_en'            =>  'Company Address English',
            'company_address_ar'            =>  'Company Address Arabic',
            'company_phone'                 =>  'Company Phone',
        ];
        $data = $this->validate($request,$rules,[],$names);
        if (!file_exists('images/company/')) {
                mkdir('images/company/', 0777, true);
            }
         if($request->hasFile('company_logo') ){
            $image = $request->company_logo;
            $fileName = time().'-logo-'.$image->getClientOriginalName();
            $image->move('images/company/', $fileName);
            $uploadImage = 'images/company/'.$fileName;
            $data['company_logo']  = $uploadImage;

        }
        if($request->hasFile('company_background') ){
            $image = $request->company_background;
            $fileName = time().'-logo-'.$image->getClientOriginalName();
            $image->move('images/company/', $fileName);
            $uploadImage = 'images/company/'.$fileName;
            $data['company_background']  = $uploadImage;

        }
        $data['company_password'] = bcrypt($request->company_password);
        $company        =   Company::create($data);
        $adminUser      =   Admins::create([
                                'admin_name'            =>  $data['company_name_en'],
                                'admin_username'        =>  $data['company_username'],
                                'admin_email'           =>  $data['company_email'],
                                'admin_password'        =>  $data['company_password'],
                                'admin_status'          =>  1,
                                'admin_type'            =>  2,   
                            ]);
        $companyUser    =   CompanyUsers::create([
                                'company_id'        =>  $company->company_id,
                                'admin_id'          =>  $adminUser->admin_id,
                            ]);  
        return redirect()->route('company.index')->with('success','Company added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('roleview', auth()->user()->type->roles->company_view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('roleupdate', auth()->user()->type->roles->company_update);
        $id      = decrypt($id);
        $company = Company::findOrFail($id);
        return view('panel.company.edit',['company'=>$company]);
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
        $this->authorize('roleupdate', auth()->user()->type->roles->company_update);
        $id    = decrypt($id);
        $rules = [
            'company_name_en'               =>  'required|string|max:100',
            'company_name_ar'               =>  'required|string|max:100',
            // 'company_logo'                  =>  'required|image|mimes:jpeg,jpg,png,bmp,gif',
            'company_color'                 =>  'required|string',
            // 'company_background'            =>  'nullable|image|mimes:jpeg,jpg,png,bmp,gif',
            'company_address_en'            =>  'nullable|string',
            'company_address_ar'            =>  'nullable|string',
            'company_phone'                 =>  'nullable|numeric',
        ];
        $names = [
            'company_name_en'               =>  'Company Admin Name English',
            'company_name_ar'               =>  'Company Admin Name Arabic',
            'company_logo'                  =>  'Company Logo',
            'company_color'                 =>  'Company App Background Color',
            'company_background'            =>  'Company Background',
            'company_address_en'            =>  'Company Address English',
            'company_address_ar'            =>  'Company Address Arabic',
            'company_phone'                 =>  'Company Phone',
        ];
        if($request->has('company_logo')  && $request->company_logo)
        {
             $rules['company_logo']                = 'required|image|mimes:jpeg,jpg,png,bmp,gif';
        }
        if($request->has('company_background')  && $request->company_background)
        {
             $rules['company_background']         = 'nullable|image|mimes:jpeg,jpg,png,bmp,gif';
        }
        $data = $this->validate($request,$rules,[],$names);

         if (!file_exists('images/company/')) {
                mkdir('images/company/', 0777, true);
            }
         if($request->hasFile('company_logo') ){
            $image = $request->company_logo;
            $fileName = time().'-logo-'.$image->getClientOriginalName();
            $image->move('images/company/', $fileName);
            $uploadImage = 'images/company/'.$fileName;
            $data['company_logo']  = $uploadImage;

        }
        if($request->hasFile('company_background') ){
            $image = $request->company_background;
            $fileName = time().'-logo-'.$image->getClientOriginalName();
            $image->move('images/company/', $fileName);
            $uploadImage = 'images/company/'.$fileName;
            $data['company_background']  = $uploadImage;

        }
        $company =  Company::findOrFail($id)->update($data);
        return redirect()->route('company.index')->with('success','Company Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('roledelete', auth()->user()->type->roles->company_delete);
        $id      = decrypt($id);
        $company = Company::findOrFail($id);
        $branchQuestions = BranchQuestions::where('company_id',$company->company_id)->get();
        foreach($branchQuestions as $compQuestion)
        {
            $compQuestion->delete();
        }
        $branches = Branches::where('company_id',$company->company_id)->get();
        foreach ($branches as $branch) {
            $branch->delete();
        }
        $reviews = Reviews::where('company_id',$company->company_id)->get();
        foreach($reviews as $review)
        {
            $review->delete();
        }
        $answers = ReviewAnswer::where('company_id',$company->company_id)->get();
        foreach($answers as $answer)
        {
            $answer->delete();
        }
        $compUsers = CompanyUsers::where('company_id',$company->company_id)->get();
        foreach ($compUsers as $user) {
            $user->user->delete();
            $user->delete();
        }
        $questions = Questions::where('company_id',$company->company_id)->get();
        foreach ($questions as $question) {
            $options = QuestionOptions::where('question_id',$question->question_id)->get();
                foreach ($options as $option) {
                     File::delete($option->option_image);
                     $option->delete();
                }
            
            $question->delete();
        }
        $company->delete();
        return redirect()->route('company.index')->with('success','Company Deleted successfully');
    }

    // public function companyBranches($id)
    // {
    //     $company  = Company::findOrFail($id);
    //     $branches = Branches::where('company_id',$company->company_id)->get();
    //     return view('panel.company.branches.index',['branches'=>$branches,'company'=>$company]);
    // }
    // public function createBranches($id)
    // {
    //     $company =  Company::findOrFail($id);
    //     return view('panel.company.branches.create',$company)
    // }
}
