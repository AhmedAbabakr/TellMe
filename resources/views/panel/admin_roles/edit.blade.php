@extends('layouts.app')
@section('content')

        <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{route('admin_roles.index')}}">Manage Roles</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Edit Admin Type</li>
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
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('admin_roles.update',encrypt($type->admin_type_id))}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('PUT')
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Type Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('admin_type_name')) is-valid @endif" id="namee" name="admin_type_name" value="{{$type->admin_type_name}}" >
                                          <span class="help-block">@if ($errors->has('admin_type_name'))
                                                  {{ $errors->first('admin_type_name') }}
                                              @endif</span>
                                      </div>
                                  </div>
         
                                  <div class="form-group">
                                          <label class="col-sm-2 control-label">Type Status </label>
                                          <div class="col-sm-10">
                                              <select class="required number form-control @if ($errors->has('admin_type_is_active')) is-valid @endif" name="admin_type_is_active" >
                                                 <option  value="" disabled="disabled" selected="">Select Status</option>
                                                            <option value="1" 
                                                            
                                                            @if($type->admin_type_is_active == 1)

                                                               {{"selected"}}
                                                            @endif >Active</option>
                                                            <option value="0" 
                                                            
                                                            @if($type->admin_type_is_active == 0)

                                                               {{"selected"}}
                                                            @endif >In-active</option>
                                                           
                                                         
                                              </select>
                                              <span class="help-block">@if ($errors->has('admin_type_is_active'))
                                                      {{ $errors->first('admin_type_is_active') }}
                                                  @endif</span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Used By Company </label>
                                          <div class="col-sm-10">
                                              <select class="required number form-control @if ($errors->has('admin_type_enable_to_company')) is-valid @endif" name="admin_type_enable_to_company" >
                                                 <option  value="" disabled="disabled" selected="">Select Status</option>
                                                            <option value="1" 
                                                            
                                                            @if($type->admin_type_enable_to_company === 1)

                                                               {{"selected"}}
                                                            @endif >Enable</option>
                                                            <option value="0" 
                                                            
                                                            @if($type->admin_type_enable_to_company === 0)

                                                               {{"selected"}}
                                                            @endif >Disable</option>
                                                           
                                                         
                                              </select>
                                              <span class="help-block">@if ($errors->has('admin_type_enable_to_company'))
                                                      {{ $errors->first('admin_type_enable_to_company') }}
                                                  @endif</span>
                                          </div>
                                      </div>
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('admin_roles.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                            
                         </div>
                      </section>
                </div>
              </div>
@endsection