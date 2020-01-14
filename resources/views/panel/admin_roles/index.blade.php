@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Manage Roles</li>
                            
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
                  Manage Roles
                @can('rolecreate', auth()->user()->type->roles->admintype_create)
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('admin_roles.create')}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Add Admin Type
                              </a>
	             </span>
               @endcan
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Types</th>
                  <th>Status</th>
                  <th>Used By Company Status</th>
                  @if(auth()->user()->type->admin_type_id === 1)
                    <th>Manage Role</th>
                  @endif
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
             	    @foreach($roles as $role)
                  <tr>

                    <td>{{$role->admin_type_name}}</td>
                    <td>@if($role->admin_type_is_active === 1)Active @else Inactive @endif</td>
                    <td>@if($role->admin_type_enable_to_company === 1)Enable @else Disable @endif</td>
                    @if(auth()->user()->type->admin_type_id === 1)
                      <td><a class="btn btn-info btn-xs" title="Edit" href="{{route('manage.role',encrypt($role->admin_type_id))}}"><i class="fa fa-gear (alias)"></i></a></td>
                    @endif
                    <td>
                    @can('roleupdate', auth()->user()->type->roles->admintype_update)
                      <a class="btn btn-primary btn-xs" title="Edit" href="{{route('admin_roles.edit',encrypt($role->admin_type_id))}}"><i class="fa fa-pencil"></i></a>
                    @endcan
                    @can('roledelete', auth()->user()->type->roles->admintype_delete)
                      @if($role->admin_type_id !== 2)
                        <a title="Delete" data-toggle="modal" href="#deModal{{$role->admin_type_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                      @endif
                    @endcan
                    </td>
                  </tr>     
                         @can('roledelete', auth()->user()->type->roles->admintype_delete)
                <div class="modal fade" id="deModal{{$role->admin_type_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                              <form method="POST"  action="{{route('admin_roles.destroy',encrypt($role->admin_type_id))}}">
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