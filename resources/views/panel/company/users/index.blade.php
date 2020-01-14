@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                               <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Company Users</li>
                            
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
                  Companies User
                  @can('rolecreate', auth()->user()->type->roles->company_user_create)
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('users.create')}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Add Company User
                              </a>
	             </span>
               @endcan
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Name</th>
                  <th>Username</th>
                  <th>E-mail</th>
                  <th>Admin Type</th>
                  <th>Status</th>
                  @if(auth()->user()->company === null)
                  <th>Company</th>
                  @endif
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
             	    @foreach($users as $user)
                  <tr>

                    <td>{{$user->admin_name}}</td>
                    <td>{{$user->admin_username}}</td>
                    <td>{{$user->admin_email}}</td>
                    <td>{{$user->type->admin_type_name}}</td>
                    <td>@if($user->admin_status === 1)Active @else Inactive @endif</td>
                     @if(auth()->user()->company === null)
                      <td>{{$user->company->company->company_name_en}}</td>
                      @endif
                    <td>
                   @can('roleupdate', auth()->user()->type->roles->company_user_update)
                      <a class="btn btn-primary btn-xs" title="Edit" href="{{route('users.edit',encrypt($user->admin_id))}}"><i class="fa fa-pencil"></i></a>
                    @endcan
                     @can('roledelete', auth()->user()->type->roles->company_user_delete)
                      <a title="Delete" data-toggle="modal" href="#deModal{{$user->admin_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                      @endcan
                    </td> 
                  </tr>      
                    @can('roledelete', auth()->user()->type->roles->company_user_delete)   
                <div class="modal fade" id="deModal{{$user->admin_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                              <form method="POST"  action="{{route('users.destroy',encrypt($user->admin_id))}}">
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