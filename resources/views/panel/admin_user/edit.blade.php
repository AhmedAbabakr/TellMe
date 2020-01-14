@extends('layouts.app')
@section('content')

             <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{route('admins_user.index')}}">Admins Users</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Edit Admin User</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                        <div class="col-sm-12">
                 @if(Session::has('success'))
                  <div class="alert alert-success" role="alert">
                    {{Session('success')}}
                  </div>
                  @endif
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('admins_user.update',encrypt($admin->admin_id))}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('PUT')
                                 <div class="form-group">
                                      <label class="col-sm-2 control-label">Admin Type </label>
                                      <div class="col-sm-10">
                                          <select class="required number form-control @if ($errors->has('admin_type')) is-valid @endif" name="admin_type" >
                                             <option  value="" disabled="disabled" selected="">Select Type</option>
                                                        @foreach($types as $type)

                                                        <option value="{{$type->admin_type_id}}" 
                                                        
                                                        @if($admin->admin_type == $type->admin_type_id)

                                                           {{"selected"}}
                                                        @endif >{{$type->admin_type_name}}</option>
                                                       @endforeach
                                          </select>
                                          <span class="help-block">@if ($errors->has('admin_type'))
                                                  {{ $errors->first('admin_type') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Admin Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('admin_name')) is-valid @endif" id="namee" name="admin_name" value="{{$admin->admin_name}}" >
                                          <span class="help-block">@if ($errors->has('admin_name'))
                                                  {{ $errors->first('admin_name') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Username </label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('admin_username')) is-valid @endif"  name="admin_username" value="{{$admin->admin_username}}">
                                          <span class="help-block">@if ($errors->has('admin_username'))
                                                  {{ $errors->first('admin_username') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Password </label>
                                      <div class="col-sm-10">
                                          <input type="password" class=" form-control @if ($errors->has('admin_password')) is-valid @endif"  name="admin_password" >
                                          <span class="help-block">@if ($errors->has('admin_password'))
                                                  {{ $errors->first('admin_password') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Confirm Password </label>
                                      <div class="col-sm-10">
                                          <input type="password" class=" form-control @if ($errors->has('admin_password')) is-valid @endif"  name="admin_password_confirmation" > 
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Email (Optional)</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control @if ($errors->has('admin_email')) is-valid @endif"  name="admin_email" value="{{$admin->admin_email}}">
                                          <span class="help-block">@if ($errors->has('admin_email'))
                                                  {{ $errors->first('admin_email') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                 
                                    <div class="form-group">
                                          <label class="col-sm-2 control-label">User Status </label>
                                          <div class="col-sm-10">
                                              <select class="required number form-control @if ($errors->has('admin_status')) is-valid @endif" name="admin_status" >
                                                 <option  value="" disabled="disabled" selected="">Select Status</option>
                                                            <option value="1" 
                                                            
                                                            @if($admin->admin_status == 1)

                                                               {{"selected"}}
                                                            @endif >Active</option>
                                                            <option value="0" 
                                                            
                                                            @if($admin->admin_status == 0)

                                                               {{"selected"}}
                                                            @endif >In-active</option>
                                                           
                                                         
                                              </select>
                                              <span class="help-block">@if ($errors->has('admin_status'))
                                                      {{ $errors->first('admin_status') }}
                                                  @endif</span>
                                          </div>
                                        </div>
                              
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('admins_user.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                            
                         </div>
                      </section>
                </div>
              </div>
@endsection