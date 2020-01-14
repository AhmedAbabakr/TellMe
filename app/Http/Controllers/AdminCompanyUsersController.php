<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyUsers;
use App\Company;
use App\Admins;
use App\Admin_type;
class AdminCompanyUsersController extends Controller
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
        $this->authorize('roleview', auth()->user()->type->roles->company_user_view);
        if(auth()->user()->company === null)
        {
            $selectUsers = CompanyUsers::select('admin_id')->get()->toArray();
            $users       = Admins::where('admin_type','<>',1)->where('admin_type','<>',2)->whereIn('admin_id',$selectUsers)->get();
        }else{
            $selectUsers = CompanyUsers::where('company_id',auth()->user()->company->company_id)->select('admin_id')->get()->toArray();
            $users       = Admins::where('admin_type','!=',1)->where('admin_type','!=',2)->whereIn('admin_id',$selectUsers)->get();
        }

        return view('panel.company.users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->company_user_create);
        $types          = Admin_type::where('admin_type_is_active',1)->where('admin_type_id','<>',1)->where('admin_type_id','<>',2)->where('admin_type_enable_to_company',1)->get();
        $companies      = Company::all();
        return view('panel.company.users.create',['types'=>$types,'companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->company_user_create);
        $types = Admin_type::where('admin_type_is_active',1)->where('admin_type_id','<>',1)->where('admin_type_id','<>',2)->where('admin_type_enable_to_company',1)->pluck('admin_type_id')->toArray();
        $rules = [
                    'admin_type'            =>  "required|integer|exists:admin_types,admin_type_id|in:". implode(',', $types),
                    'admin_name'            =>  'required|string|max:50',
                    'admin_username'        =>  'required|string|max:50|unique:admins,admin_username',
                    'admin_password'        =>  'required|string|min:8|confirmed',
                    'admin_email'           =>  'nullable|string|email|max:255|unique:admins,admin_email',
                    'admin_status'          =>  'required|integer|between:0,1',
                ];
        $names = [
                    'admin_type'            =>  'Admin Type',
                    'admin_name'            =>  'Name',
                    'admin_username'        =>  'Username',
                    'admin_password'        =>  'Password',
                    'admin_email'           =>  'Email',
                    'admin_status'          =>  'Status',
                ];
        if($request->has('company_id')  && $request->company_id)
        {
            $rules['company_id']                = 'required|integer|exists:companies,company_id';
        }
        $data   =   $this->validate($request,$rules,[],$names);
        $data['admin_password'] = bcrypt($request->admin_password);
        $user  =   Admins::create($data);
        if(auth()->user()->company !== null)
        {
            $data['company_id'] = auth()->user()->company->company_id;
        }

        $companyUser    =   CompanyUsers::create([
                                'company_id'        =>  $data['company_id'],
                                'admin_id'          =>  $user->admin_id,
                            ]);  
        return redirect()->route('users.index')->with('success','User added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('roleview', auth()->user()->type->roles->company_user_view);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('roleupdate', auth()->user()->type->roles->company_user_update);
        $id             = decrypt($id);
        $user           = Admins::findOrFail($id);
        $types          = Admin_type::where('admin_type_is_active',1)->where('admin_type_id','<>',1)->where('admin_type_id','<>',2)->where('admin_type_enable_to_company',1)->get();
        $companies      = Company::all();
        return view('panel.company.users.edit',['types'=>$types,'companies'=>$companies,'user'=>$user]);
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
        $this->authorize('roleupdate', auth()->user()->type->roles->company_user_update);
        $id    = decrypt($id);
        $user  = Admins::findOrFail($id);
        $types = Admin_type::where('admin_type_is_active',1)->where('admin_type_id','<>',1)->where('admin_type_id','<>',2)->where('admin_type_enable_to_company',1)->pluck('admin_type_id')->toArray();
        $rules = [
                    'admin_type'            =>  "required|integer|exists:admin_types,admin_type_id|in:". implode(',', $types),
                    'admin_name'            =>  'required|string|max:50',
                    'admin_username'        =>  "required|string|max:50|unique:admins,admin_username,$id,admin_id",
                    // 'admin_password'        =>  'required|string|min:8|confirmed',
                    'admin_email'           =>  "nullable|string|email|max:255|unique:admins,admin_email,$id,admin_id",
                    'admin_status'          =>  'required|integer|between:0,1',
                ];
        if($request->has('admin_password') && $request->admin_password)
        {
            $rules['admin_password'] =  'required|string|min:8|confirmed';
        }
        if($request->has('company_id')  && $request->company_id)
        {
            $rules['company_id']                = 'required|integer|exists:companies,company_id';
        }
        $names = [
                    'admin_type'            =>  'Admin Type',
                    'admin_name'            =>  'Name',
                    'admin_username'        =>  'Username',
                    'admin_password'        =>  'Password',
                    'admin_email'           =>  'Email',
                    'admin_status'          =>  'Status',
                ];
        $data   =   $this->validate($request,$rules,[],$names);
        if($request->has('admin_password') && $request->admin_password)
        {
            $data['admin_password'] = bcrypt($request->admin_password);
        }
        $user->update($data);
        if(auth()->user()->company !== null)
        {
            $data['company_id'] = auth()->user()->company->company_id;
        }

        $companyUser    =   CompanyUsers::where('admin_id',$user->admin_id)->update([
                                'company_id'        =>  $data['company_id']
                            ]);  

        return redirect()->route('users.index')->with('success','Company User Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('roledelete', auth()->user()->type->roles->company_user_delete);
        $id    = decrypt($id);
        $admin = Admins::findOrFail($id);
        $companyUser = CompanyUsers::where('admin_id',$admin->admin_id)->firstOrFail()->delete();
        $admin->delete();
        return redirect()->route('users.index')->with('success','Company User Deleted successfully');
    }
}
