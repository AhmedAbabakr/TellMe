@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Admins Users</li>
                            
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
                  Admins User
                @can('rolecreate', auth()->user()->type->roles->admins_user_create)
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('admins_user.create')}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Add Admin User
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
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
             	    @foreach($admins as $admin)
                  <tr>

                    <td>{{$admin->admin_name}}</td>
                    <td>{{$admin->admin_username}}</td>
                    <td>{{$admin->admin_email}}</td>
                    <td>{{$admin->type->admin_type_name}}</td>
                    <td>@if($admin->admin_status === 1)Active @else Inactive @endif</td>
                      <td>
                    @can('roleupdate', auth()->user()->type->roles->admins_user_update)
                        <a class="btn btn-primary btn-xs" title="Edit" href="{{route('admins_user.edit',encrypt($admin->admin_id))}}"><i class="fa fa-pencil"></i></a>
                    @endcan 
                     @can('roledelete', auth()->user()->type->roles->admins_user_delete)
                      <a title="Delete" data-toggle="modal" href="#deModal{{$admin->admin_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                      @endcan
                    </td>
                  </tr> 
                  @can('roledelete', auth()->user()->type->roles->admins_user_delete)   
                <div class="modal fade" id="deModal{{$admin->admin_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                              <form method="POST"  action="{{route('admins_user.destroy',encrypt($admin->admin_id))}}">
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