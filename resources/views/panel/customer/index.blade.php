@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Customer Reviews</li>
                            
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                 @if(Session::has('success'))
                  <div class="alert alert-success" role="alert">
                    {{Session('success')}}
                  </div>
                  @endif
              <section class="card">
              <header class="card-header">
                  Customer Reviews
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Customer Name</th>
                  <th>Customer Phone</th>
                  <th>Customer E-mail</th>
                  <th>Branch</th>
                  <th>Company</th>
                  <th>Case</th>
                  <th>Created Time</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
             	    @foreach($reviews as $review)
                  <tr>

                    <td>{{$review->customer_name}}</td>
                    <td>{{$review->customer_phone}}</td>
                    <td>{{$review->customer_email}}</td>
                    <td>{{$review->branch->branch_name}}</td>
                    <td>{{$review->company->company_name_en}}</td>
                    <td>@if($review->review_case === 1)Closed @else Open @endif
                    <td>{{$review->created_at->diffForHumans()}}</td>
                      <td>
                          @can('roleview', auth()->user()->type->roles->customer_review_view)
                          <a class="btn btn-success btn-xs" title="Show" href="{{route('customers.show',encrypt($review->review_id))}}"><i class="fa fa-eye"></i></a> 
                          @endcan
                          @can('rolecreate', auth()->user()->type->roles->customer_review_mail)
                          @if($review->customer_email !== null) 
                          <a class="btn btn-info btn-xs" title="Send Request" href="{{route('newReview',encrypt($review->review_id))}}"><i class="fa fa-envelope"></i></a>
                          @endif  
                          @endcan
                           @can('roledelete', auth()->user()->type->roles->customer_review_delete)
                            <a title="Delete" data-toggle="modal" href="#deModal{{$review->review_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                            @endcan
                    </td>
                  </tr>
                  @can('roledelete', auth()->user()->type->roles->customer_review_delete)   
                <div class="modal fade" id="deModal{{$review->review_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Delete Confirmation</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this record.
                           <!-- <input type="hidden" id="catidh" value=""/>-->
                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                              <form method="POST"  action="{{route('customers.destroy',encrypt($review->review_id))}}">
                                @csrf
                                @method('Delete')
                                <button type="submit" class="btn btn-danger">Confirm</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div> 
                @endcan                            
                  @endforeach 
              </tbody>
              </tfoot>
              </table>
              </div>
              </div>
              </section>
              </div></div>
             
@endsection