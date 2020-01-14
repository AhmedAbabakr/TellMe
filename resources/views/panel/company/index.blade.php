@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Companies</li>
                            
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
                  Companies

             @can('rolecreate', auth()->user()->type->roles->company_create)
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('company.create')}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Add Company
                              </a>
	             </span>
               @endcan
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Company English Name</th>
                  <th>Company Arabic Name</th>
                  <th>Count Users</th>
                  <th>Count Branches</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
           	    @foreach($companies as $company)
                <tr>

                  <td>{{$company->company_name_en}}</td>
                  <td>{{$company->company_name_ar}}</td>
                  <td>{{$company->admin->count()}}</td>
                   <td>{{$company->branch->count()}}</td>
                   <td>
                   @can('roleupdate', auth()->user()->type->roles->company_update)
                      <a class="btn btn-primary btn-xs" title="Edit" href="{{route('company.edit',encrypt($company->company_id))}}"><i class="fa fa-pencil"></i></a>
                  @endcan
                  @can('roledelete', auth()->user()->type->roles->company_delete)
                      <a title="Delete" data-toggle="modal" href="#deModal{{$company->company_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                      @endcan
                  </td>
                </tr>   
                 @can('roledelete', auth()->user()->type->roles->company_delete)   
                <div class="modal fade" id="deModal{{$company->company_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                              <form method="POST"  action="{{route('company.destroy',encrypt($company->company_id))}}">
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