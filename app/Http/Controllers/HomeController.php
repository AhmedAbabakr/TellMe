<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;
use App\Branches;
use App\Company;
use App\Reviews;
use App\Questions;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:admins');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->company === null)
        {
            $totalCompanies  =    Company::count();
            $totalBranches   =    Branches::count();
            $totalReviews    =    Reviews::count();
            $totalQuestions  =    Questions::count();
        }else{

            $totalCompanies  =    Company::where('company_id',auth()->user()->company->company_id)->count();
            $totalBranches   =    Branches::where('company_id',auth()->user()->company->company_id)->count();
            $totalReviews    =    Reviews::where('company_id',auth()->user()->company->company_id)->count();
            $totalQuestions  =    Questions::where('company_id',auth()->user()->company->company_id)->count();
        }
        return view('home',['companies'=>$totalCompanies,'branches'=>$totalBranches,'reviews'=>$totalReviews,'questions'=>$totalQuestions]);
    }
    public function setting()
    {
        $settings = Settings::all();

        return view('panel.settings.setting',['settings'=>$settings]);
    }
    public function appSettingUpdate(Request $request)
    {
        
        foreach ($request->except(['_token','_method']) as $key => $value) {
            if($key === 'MAIL_USERNAME')

            {
                $rules[$key] = "required|email";
            }else
            {
                $rules[$key] = 'required|string';
            }
            $name = [$key => __("message.$key")];
            $this->validate($request,$rules,[],$name); 
            $settings=Settings::where('setting_key',$key)->firstOrFail();
            $settings->update(['setting_value'=>$value]);
        }
       
       
        return redirect()->route('app.setting')->with('success','Setting Updated successfully');
    }
}
