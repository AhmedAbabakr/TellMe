<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admins;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }
    public function settings()
    {
    	return view('panel.user.setting');
    }
    public function updateSettings(Request $request)
    {
    	$id =auth()->user()->admin_id;
    	$rules 	= [
    				'admin_name'            =>  'required|string|max:50',
                    'admin_username'        =>  "required|string|max:50|unique:admins,admin_username,$id,admin_id",
					'admin_email'           =>  "nullable|string|email|max:255|unique:admins,admin_email,$id,admin_id",
			 	];
		$names  = [
    				'admin_name'            =>  'Name',
                    'admin_username'        =>  "Username",
					'admin_email'           =>  "Email",
                    'admin_password'        =>  'Password',			
				];
		if($request->has('admin_password') && $request->admin_password)
        {
            $rules['admin_password'] =  'required|string|min:8|confirmed';
        }
        $data   =   $this->validate($request,$rules,[],$names);
        if($request->has('admin_password') && $request->admin_password)
        {
            $data['admin_password'] = bcrypt($request->admin_password);
        }
        $user = Admins::findOrFail(auth()->user()->admin_id)->update($data);
        return redirect()->back()->with('success','Settings Updated successfully');
    }
}
