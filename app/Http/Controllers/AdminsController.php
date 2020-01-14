<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admins;
use App\Admin_type;
use App\CompanyUsers;

class AdminsController extends Controller
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
        $this->authorize('roleview', auth()->user()->type->roles->admins_user_view);
        $admins = Admins::where('admin_type','<>',1)->with('type')->get();
        return view('panel.admin_user.index',['admins'=>$admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->admins_user_create);        
        $types = Admin_type::where('admin_type_is_active',1)->where('admin_type_id','<>',1)->get();
        return view('panel.admin_user.create',['types'=>$types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->admins_user_create);        
        $rules = [
                    'admin_type'            =>  'required|integer|exists:admin_types,admin_type_id|gt:1',
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
        $data   =   $this->validate($request,$rules,[],$names);
        $data['admin_password'] = bcrypt($request->admin_password);
        $admin  =   Admins::create($data);
        return redirect()->route('admins_user.index')->with('success','Admin User added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('roleview', auth()->user()->type->roles->admins_user_view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('roleupdate', auth()->user()->type->roles->admins_user_update);
        $id    = decrypt($id);
        $admin = Admins::findOrFail($id);
        $types = Admin_type::where('admin_type_is_active',1)->where('admin_type_id','<>',1)->get();
        return view('panel.admin_user.edit',['admin'=>$admin,'types'=>$types]);
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
        $this->authorize('roleupdate', auth()->user()->type->roles->admins_user_update);
        $id    = decrypt($id);
        $rules = [
                    'admin_type'            =>  'required|integer|exists:admin_types,admin_type_id|gt:1',
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
        $admin = Admins::findOrFail($id)->update($data);
        return redirect()->route('admins_user.index')->with('success','Admin User Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('roledelete', auth()->user()->type->roles->admins_user_delete);
        $id    = decrypt($id);
        $admin = Admins::findOrFail($id);
        if($admin->company !== null)
        {
            $companyUser = CompanyUsers::where('admin_id',$admin->admin_id)->firstOrFail()->delete();
        }
        $admin->delete();
        return redirect()->route('admins_user.index')->with('success','Admin User Deleted successfully');
    }
}
