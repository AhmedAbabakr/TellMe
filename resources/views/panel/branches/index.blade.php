@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Company Branches</li>
                            
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
                   Branches
                   @can('rolecreate', auth()->user()->type->roles->company_branch_create)
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('branch.create')}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Add Company Branch
                              </a>
	             </span>
               @endcan
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Branch Name</th>
                  <th>Branch Code</th>
                  <th>Company</th>
                  <th>Made By</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
             	    @foreach($branches as $branch)
                  <tr>

                    <td>{{$branch->branch_name}}</td>
                    <td>{{$branch->branch_code}}</td>
                 
                    <td>{{$branch->company->company_name_en}}</td>
                    <td>{{$branch->branch_made_by}}</td> 
                    <td>
                   @can('roleupdate', auth()->user()->type->roles->company_branch_update)
                      <a class="btn btn-primary btn-xs" title="Edit" href="{{route('branch.edit',encrypt($branch->branch_id))}}"><i class="fa fa-pencil"></i></a>
                    @endcan

                   @can('roleview', auth()->user()->type->roles->company_branch_question_view)
                      <a class="btn btn-info btn-xs" title="Questions" href="{{route('branch.assign.index',encrypt($branch->branch_id))}}"><i class="fa fa-question-circle"></i></a>
                    @endcan
                    @can('roledelete', auth()->user()->type->roles->company_branch_question_delete)
                      <a title="Delete" data-toggle="modal" href="#deModal{{$branch->branch_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                      @endcan
                    </td> 
                  </tr>   
                    @can('roledelete', auth()->user()->type->roles->company_branch_question_delete)   
                <div class="modal fade" id="deModal{{$branch->branch_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                              <form method="POST"  action="{{route('branch.destroy',encrypt($branch->branch_id))}}">
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