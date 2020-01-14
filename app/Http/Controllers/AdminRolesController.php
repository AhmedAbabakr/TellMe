<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin_type;
use App\Manage_role;
use App\Admins;
use App\CompanyUsers;
use Vinkla\Hashids\Facades\Hashids;

class AdminRolesController extends Controller
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

        $this->authorize('roleview', auth()->user()->type->roles->admintype_view);
        // dd(Admin_type::with('user')->get());
        $roles = Admin_type::where('admin_type_id','<>',1)->get();
        return view('panel.admin_roles.index',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->admintype_create);
        return view('panel.admin_roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->admintype_create);
        $rules = [
            'admin_type_name'                   =>  'required|string|max:20',
            'admin_type_is_active'              =>  'required|integer|between:0,1',
            'admin_type_enable_to_company'      =>  'required|integer|between:0,1',
        ];
        $names = [
            'admin_type_name'                   =>  'Admin Type',
            'admin_type_is_active'              =>  'Type Status',
            'admin_type_enable_to_company'      =>  'Used By Company Status',
        ];
        $data   = $this->validate($request,$rules,[],$names);
        $type   = Admin_type::create($data);
        $roles  = Manage_role::create(['admin_type'=>$type->admin_type_id]);
        return redirect()->route('admin_roles.index')->with('success','Admin Type added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('roleview', auth()->user()->type->roles->admintype_view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('roleupdate', auth()->user()->type->roles->admintype_update);
        $id   = decrypt($id);
        $type = Admin_type::findOrFail($id);
        return view('panel.admin_roles.edit',['type'=>$type]);
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
        $this->authorize('roleupdate', auth()->user()->type->roles->admintype_update);
        $id    = decrypt($id);
        $rules = [
            'admin_type_name'                   =>  'required|string|max:20',
            'admin_type_is_active'              =>  'required|integer|between:0,1',
            'admin_type_enable_to_company'      =>  'required|integer|between:0,1',
        ];
        $names = [
            'admin_type_name'                   =>  'Admin Type',
            'admin_type_is_active'              =>  'Type Status',
            'admin_type_enable_to_company'      =>  'Used By Company Status',
        ];
        $data = $this->validate($request,$rules,[],$names);
        $type= Admin_type::findOrFail($id)->update($data);
        return redirect()->route('admin_roles.index')->with('success','Admin Type Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('roledelete', auth()->user()->type->roles->admintype_delete);
        $id    = decrypt($id);
        $type = Admin_type::findOrFail($id);
        $admins = Admins::where('admin_type',$type->admin_type_id)->get();
        foreach($admins as $admin)
        {
            if($admin->company !== null)
            {
                $admin->company->delete();
            }
            $admin->delete();
        }
        $type->delete();
        return redirect()->route('admin_roles.index')->with('success','Admin Type Deleted successfully');

    }
    public function manage_roles($id)
    {
        if(auth()->user()->type->admin_type_id === 1)
        {
            $id    = decrypt($id);
            $roles = Manage_role::where('admin_type',$id)->firstOrFail();
            return view('panel.admin_roles.manage_roles',['roles'=>$roles]);
        }else{
            return abort(404);
        }
    }
    public function manage_roles_update(Request $request,$id)
    {

        if(auth()->user()->type->admin_type_id === 1)
        {
            $id    = decrypt($id);
            $rules = [
                'admintype_view'                =>  'required|integer|between:0,1',
                'admintype_create'              =>  'required|integer|between:0,1',
                'admintype_update'              =>  'required|integer|between:0,1',
                'admintype_delete'              =>  'required|integer|between:0,1',
                'admins_user_view'              =>  'required|integer|between:0,1',
                'admins_user_create'            =>  'required|integer|between:0,1',
                'admins_user_update'            =>  'required|integer|between:0,1',
                'admins_user_delete'            =>  'required|integer|between:0,1',
                'company_view'                  =>  'required|integer|between:0,1',
                'company_create'                =>  'required|integer|between:0,1',
                'company_update'                =>  'required|integer|between:0,1',
                'company_delete'                =>  'required|integer|between:0,1',
                'company_branch_view'           =>  'required|integer|between:0,1',
                'company_branch_create'         =>  'required|integer|between:0,1',
                'company_branch_update'         =>  'required|integer|between:0,1',
                'company_branch_delete'         =>  'required|integer|between:0,1',
                'company_branch_question_view'  =>  'required|integer|between:0,1',
                'company_branch_question_assign'=>  'required|integer|between:0,1',
                'company_branch_question_delete'=>  'required|integer|between:0,1',
                'company_user_view'             =>  'required|integer|between:0,1',
                'company_user_create'           =>  'required|integer|between:0,1',
                'company_user_update'           =>  'required|integer|between:0,1',
                'company_user_delete'           =>  'required|integer|between:0,1',
                'question_view'                 =>  'required|integer|between:0,1',
                'question_create'               =>  'required|integer|between:0,1',
                'question_update'               =>  'required|integer|between:0,1',
                'question_delete'               =>  'required|integer|between:0,1',
                'question_options_view'         =>  'required|integer|between:0,1',
                'question_options_create'       =>  'required|integer|between:0,1',
                'question_options_update'       =>  'required|integer|between:0,1',
                'question_options_delete'       =>  'required|integer|between:0,1',
                'customer_review_view'          =>  'required|integer|between:0,1',
                'customer_review_mail'          =>  'required|integer|between:0,1',
                'customer_review_delete'        =>  'required|integer|between:0,1',
            ];
            $names = [
                'admintype_view'                =>  'Admin Type View',
                'admintype_create'              =>  'Admin Type Create',
                'admintype_update'              =>  'Admin Type Update',
                'admintype_delete'              =>  'Admin Type Delete',
                'admins_user_view'              =>  'Admin User View',
                'admins_user_create'            =>  'Admin User Create',
                'admins_user_update'            =>  'Admin User Update',
                'admins_user_delete'            =>  'Admin User Delete',
                'company_view'                  =>  'Companies View',
                'company_create'                =>  'Companies Create',
                'company_update'                =>  'Companies Update',
                'company_delete'                =>  'Companies Delete',
                'company_branch_view'           =>  'Branches View',
                'company_branch_create'         =>  'Branches Create',
                'company_branch_update'         =>  'Branches Update',
                'company_branch_delete'         =>  'Branches Delete',
                'company_branch_question_view'  =>  'Assigned Question View',
                'company_branch_question_assign'=>  'Assign Question',
                'company_branch_question_delete'=>  'Unassign Question To Branches',
                'company_user_view'             =>  'Companies User View',
                'company_user_create'           =>  'Companies User Create',
                'company_user_update'           =>  'Companies User Update',
                'company_user_delete'           =>  'Companies User Delete',
                'question_view'                 =>  'Questions View ',
                'question_create'               =>  'Questions Create',
                'question_update'               =>  'Questions Update',
                'question_delete'               =>  'Questions Delete',
                'question_options_view'         =>  'Questions Options View',
                'question_options_create'       =>  'Questions Options Create',
                'question_options_update'       =>  'Questions Options Update',
                'question_options_delete'       =>  'Questions Options Delete',
                'customer_review_view'          =>  'Customer Review View',
                'customer_review_mail'          =>  'Customer Review Mail',
                'customer_review_delete'        =>  'Customer Review Delete',
            ];
            $data = $this->validate($request,$rules,[],$names);
            $roles = Manage_role::where('admin_type',$id)->update($data);
            return redirect()->route('manage.role',encrypt($id))->with('success','Manage Roles Updated successfully');
        }else{
            return abort(404);
        }
    }
}
