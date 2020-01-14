<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReviewMail;
use App\Reviews;
use App\ReviewAnswer;
class AdminCustomerController extends Controller
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
        $this->authorize('roleview', auth()->user()->type->roles->customer_review_view);
        if(auth()->user()->company === null)
        {
            $reviews = Reviews::with('company','branch','answers')->orderBy('created_at','desc')->get();   
        }else{
            $reviews = Reviews::where('company_id',auth()->user()->company->company_id)->with('company','branch','answers')->orderBy('created_at','desc')->get();
        }
        return view('panel.customer.index',['reviews'=>$reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $this->authorize('roleview', auth()->user()->type->roles->customer_review_view);
        $id  = decrypt($id);
        if(auth()->user()->company === null)
        {
            $review = Reviews::findOrFail($id);
        }else{
            $review = Reviews::where('company_id',auth()->user()->company->company_id)->where('review_id',$id)->firstOrFail();
        }
        return view('panel.customer.show',['review'=>$review]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->authorize('roledelete', auth()->user()->type->roles->customer_review_delete);
        $id  = decrypt($id);
        $review = Reviews::findOrFail($id);
        $answers = ReviewAnswer::where('review_id',$review->review_id)->get();
        foreach($answers as $answer)
        {
            $answer->delete();
        }
        $review->delete();
        return redirect()->route('customers.index')->with('success','Customer Review Deleted Successfully');

    }
    public function MakeReview($id)
    {
        $this->authorize('rolecreate', auth()->user()->type->roles->customer_review_mail);
        $id  = decrypt($id);
        if(auth()->user()->company === null)
        {
            $review = Reviews::findOrFail($id);
        }else{
            $review = Reviews::where('company_id',auth()->user()->company->company_id)->where('review_id',$id)->firstOrFail();
        }
        $newReview = Reviews::create([
            'branch_id'                 => $review->branch_id,
            'company_id'                =>  $review->company_id,
            'customer_name'             =>  $review->customer_name,
            'customer_email'            =>  $review->customer_email,
            'customer_phone'            =>  $review->customer_phone,
            'customer_note'             =>  $review->customer_note,
            'customer_contact_method'   =>  $review->customer_contact_method,
            'review_token'              =>  str_random(60),
            'review_case'               =>  0,
        ]);
        $maildata = [
            'customer_name'                 =>  $newReview->customer_name,
            'branch_name'                   =>  $newReview->branch->branch_name,
            'company_name_en'               =>  $newReview->company->company_name_en,
            'review_id'                     =>  $newReview->review_id,
        ];
        Mail::to($newReview->customer_email)->send(new ReviewMail( $maildata));
        return redirect()->route('customers.index')->with('success','New Review Sent To Customer Successfully');
    }
}
