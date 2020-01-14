@extends('layouts.app')
@section('content')

        <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{route('admin_roles.index')}}">Manage Roles</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Manage Roles</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
               @if(Session::has('success'))
                        <div class="col-sm-12">
                  <div class="alert alert-success" role="alert">
                    {{Session('success')}}
                  </div>
                  @endif
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('manage.role.update',encrypt($roles->admin_type))}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('PUT')
                                  <section class="card">
                                      <header class="card-header">
                                          Admin Type
                                      </header>
                                      <div class="card-body">
                                          <div class="form-group">
                                              <label class="col-sm-2 control-label col-lg-2 mb-3 ">Admin Type View </label>
                                              <div class="col-lg-10">
                                                  <div class="custom-control custom-radio custom-control-inline">
                                                      <input type="radio" id="admintype_view0" name="admintype_view" class="custom-control-input @if ($errors->has('admintype_view')) is-valid @endif" value="0" @if($roles->admintype_view === 0)checked="checked"@endif>
                                                      <label class="custom-control-label" for="admintype_view0">Inactive</label>
                                                  </div>
                                                  <div class="custom-control custom-radio custom-control-inline">
                                                      <input type="radio" id="admintype_view1" name="admintype_view" class="custom-control-input @if ($errors->has('admintype_view')) is-valid @endif" value="1" @if($roles->admintype_view === 1)checked="checked"@endif>
                                                      <label class="custom-control-label" for="admintype_view1">Active</label>
                                                  </div>

                                              </div>
                                                 <span class="help-block">@if ($errors->has('admintype_view'))
                                                          {{ $errors->first('admintype_view') }}
                                                      @endif</span>
                                          </div>
                                         <div class="form-group">
                                            <label class="col-sm-2 control-label col-lg-2 mb-3">Admin Type Create </label>
                                            <div class="col-lg-10">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="admintype_create0" name="admintype_create" class="custom-control-input @if ($errors->has('admintype_create')) is-valid @endif" value="0" @if($roles->admintype_create === 0)checked="checked"@endif>
                                                    <label class="custom-control-label" for="admintype_create0">Inactive</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="admintype_create1" name="admintype_create" class="custom-control-input @if ($errors->has('admintype_create')) is-valid @endif" value="1" @if($roles->admintype_create === 1)checked="checked"@endif>
                                                    <label class="custom-control-label" for="admintype_create1"> Active</label>
                                                </div>
                                            </div>
                                                <span class="help-block">@if ($errors->has('admintype_create'))
                                                        {{ $errors->first('admintype_create') }}
                                                    @endif</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label col-lg-2 mb-3">Admin Type Update </label>
                                            <div class="col-lg-10">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="admintype_update0" name="admintype_update" class="custom-control-input @if ($errors->has('admintype_update')) is-valid @endif" value="0" @if($roles->admintype_update === 0)checked="checked"@endif>
                                                    <label class="custom-control-label" for="admintype_update0">Inactive</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="admintype_update1" name="admintype_update" class="custom-control-input @if ($errors->has('admintype_update')) is-valid @endif" value="1" @if($roles->admintype_update === 1)checked="checked"@endif>
                                                    <label class="custom-control-label" for="admintype_update1"> Active</label>
                                                </div>
                                            </div>
                                                <span class="help-block">@if ($errors->has('admintype_update'))
                                                        {{ $errors->first('admintype_update') }}
                                                    @endif</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label col-lg-2 mb-3">Admin Type Delete </label>
                                            <div class="col-lg-10">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="admintype_delete0" name="admintype_delete" class="custom-control-input @if ($errors->has('admintype_delete')) is-valid @endif" value="0" @if($roles->admintype_delete === 0)checked="checked"@endif>
                                                    <label class="custom-control-label" for="admintype_delete0">Inactive</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="admintype_delete1" name="admintype_delete" class="custom-control-input @if ($errors->has('admintype_delete')) is-valid @endif" value="1" @if($roles->admintype_delete === 1)checked="checked"@endif>
                                                    <label class="custom-control-label" for="admintype_delete1"> Active</label>
                                                </div>
                                            </div>
                                                <span class="help-block">@if ($errors->has('admintype_delete'))
                                                        {{ $errors->first('admintype_delete') }}
                                                    @endif</span>
                                        </div>
                                      </div>
                                  </section>
                                 <section class="card">
                                  <header class="card-header">
                                      Admin User
                                  </header>
                                  <div class="card-body">
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2 mb-3">Admin User View  </label>
                                        <div class="col-lg-10">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="admins_user_view0" name="admins_user_view" class="custom-control-input @if ($errors->has('admins_user_view')) is-valid @endif" value="0" @if($roles->admins_user_view === 0)checked="checked"@endif>
                                                <label class="custom-control-label" for="admins_user_view0">Inactive</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="admins_user_view1" name="admins_user_view" class="custom-control-input @if ($errors->has('admins_user_view')) is-valid @endif" value="1" @if($roles->admins_user_view === 1)checked="checked"@endif>
                                                <label class="custom-control-label" for="admins_user_view1"> Active</label>
                                            </div>
                                        </div>
                                        <span class="help-block">@if ($errors->has('admins_user_view'))
                                                {{ $errors->first('admins_user_view') }}
                                            @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Admin User Create  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="admins_user_create0" name="admins_user_create" class="custom-control-input @if ($errors->has('admins_user_create')) is-valid @endif" value="0" @if($roles->admins_user_create === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="admins_user_create0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="admins_user_create1" name="admins_user_create" class="custom-control-input @if ($errors->has('admins_user_create')) is-valid @endif" value="1" @if($roles->admins_user_create === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="admins_user_create1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('admins_user_create'))
                                                  {{ $errors->first('admins_user_create') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Admin User Update  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="admins_user_update0" name="admins_user_update" class="custom-control-input @if ($errors->has('admins_user_update')) is-valid @endif" value="0" @if($roles->admins_user_update === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="admins_user_update0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="admins_user_update1" name="admins_user_update" class="custom-control-input @if ($errors->has('admins_user_update')) is-valid @endif" value="1" @if($roles->admins_user_update === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="admins_user_update1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('admins_user_update'))
                                                  {{ $errors->first('admins_user_update') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Admin User Delete  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="admins_user_delete0" name="admins_user_delete" class="custom-control-input @if ($errors->has('admins_user_delete')) is-valid @endif" value="0" @if($roles->admins_user_delete === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="admins_user_delete0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="admins_user_delete1" name="admins_user_delete" class="custom-control-input @if ($errors->has('admins_user_delete')) is-valid @endif" value="1" @if($roles->admins_user_delete === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="admins_user_delete1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('admins_user_delete'))
                                                  {{ $errors->first('admins_user_delete') }}
                                              @endif</span>
                                      </div>
                              
                                  </div>
                                </section>
                               <section class="card">
                                <header class="card-header">
                                    Companies
                                </header>
                                <div class="card-body">
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2 mb-3">Companies View  </label>
                                      <div class="col-lg-10">
                                          <div class="custom-control custom-radio custom-control-inline">
                                              <input type="radio" id="company_view0" name="company_view" class="custom-control-input @if ($errors->has('company_view')) is-valid @endif" value="0" @if($roles->company_view === 0)checked="checked"@endif>
                                              <label class="custom-control-label" for="company_view0">Inactive</label>
                                          </div>
                                          <div class="custom-control custom-radio custom-control-inline">
                                              <input type="radio" id="company_view1" name="company_view" class="custom-control-input @if ($errors->has('company_view')) is-valid @endif" value="1" @if($roles->company_view === 1)checked="checked"@endif>
                                              <label class="custom-control-label" for="company_view1"> Active</label>
                                          </div>
                                      </div>
                                      <span class="help-block">@if ($errors->has('company_view'))
                                              {{ $errors->first('company_view') }}
                                          @endif</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2 mb-3">Companies Create  </label>
                                        <div class="col-lg-10">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="company_create0" name="company_create" class="custom-control-input @if ($errors->has('company_create')) is-valid @endif" value="0" @if($roles->company_create === 0)checked="checked"@endif>
                                                <label class="custom-control-label" for="company_create0">Inactive</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="company_create1" name="company_create" class="custom-control-input @if ($errors->has('company_create')) is-valid @endif" value="1" @if($roles->company_create === 1)checked="checked"@endif>
                                                <label class="custom-control-label" for="company_create1"> Active</label>
                                            </div>
                                        </div>
                                        <span class="help-block">@if ($errors->has('company_create'))
                                                {{ $errors->first('company_create') }}
                                            @endif</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2 mb-3">Companies Update  </label>
                                        <div class="col-lg-10">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="company_update0" name="company_update" class="custom-control-input @if ($errors->has('company_update')) is-valid @endif" value="0" @if($roles->company_update === 0)checked="checked"@endif>
                                                <label class="custom-control-label" for="company_update0">Inactive</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="company_update1" name="company_update" class="custom-control-input @if ($errors->has('company_update')) is-valid @endif" value="1" @if($roles->company_update === 1)checked="checked"@endif>
                                                <label class="custom-control-label" for="company_update1"> Active</label>
                                            </div>
                                        </div>
                                        <span class="help-block">@if ($errors->has('company_update'))
                                                {{ $errors->first('company_update') }}
                                            @endif</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2 mb-3">Companies Delete  </label>
                                        <div class="col-lg-10">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="company_delete0" name="company_delete" class="custom-control-input @if ($errors->has('company_delete')) is-valid @endif" value="0" @if($roles->company_delete === 0)checked="checked"@endif>
                                                <label class="custom-control-label" for="company_delete0">Inactive</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="company_delete1" name="company_delete" class="custom-control-input @if ($errors->has('company_delete')) is-valid @endif" value="1" @if($roles->company_delete === 1)checked="checked"@endif>
                                                <label class="custom-control-label" for="company_delete1"> Active</label>
                                            </div>
                                        </div>
                                        <span class="help-block">@if ($errors->has('company_delete'))
                                                {{ $errors->first('company_delete') }}
                                            @endif</span>
                                    </div>
                            
                                </div>
                              </section>
                              <section class="card">
                                  <header class="card-header">
                                      Companies Branches
                                  </header>
                                  <div class="card-body">
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2 mb-3">Branches View  </label>
                                        <div class="col-lg-10">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="company_branch_view0" name="company_branch_view" class="custom-control-input @if ($errors->has('company_branch_view')) is-valid @endif" value="0" @if($roles->company_branch_view === 0)checked="checked"@endif>
                                                <label class="custom-control-label" for="company_branch_view0">Inactive</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="company_branch_view1" name="company_branch_view" class="custom-control-input @if ($errors->has('company_branch_view')) is-valid @endif" value="1" @if($roles->company_branch_view === 1)checked="checked"@endif>
                                                <label class="custom-control-label" for="company_branch_view1"> Active</label>
                                            </div>
                                        </div>
                                        <span class="help-block">@if ($errors->has('company_branch_view'))
                                                {{ $errors->first('company_branch_view') }}
                                            @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Branches Create  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="company_branch_create0" name="company_branch_create" class="custom-control-input @if ($errors->has('company_branch_create')) is-valid @endif" value="0" @if($roles->company_branch_create === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="company_branch_create0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="company_branch_create1" name="company_branch_create" class="custom-control-input @if ($errors->has('company_branch_create')) is-valid @endif" value="1" @if($roles->company_branch_create === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="company_branch_create1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('company_branch_create'))
                                                  {{ $errors->first('company_branch_create') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Branches Update  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="company_branch_update0" name="company_branch_update" class="custom-control-input @if ($errors->has('company_branch_update')) is-valid @endif" value="0" @if($roles->company_branch_update === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="company_branch_update0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="company_branch_update1" name="company_branch_update" class="custom-control-input @if ($errors->has('company_branch_update')) is-valid @endif" value="1" @if($roles->company_branch_update === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="company_branch_update1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('company_branch_update'))
                                                  {{ $errors->first('company_branch_update') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Branches Delete  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="company_branch_delete0" name="company_branch_delete" class="custom-control-input @if ($errors->has('company_branch_delete')) is-valid @endif" value="0" @if($roles->company_branch_delete === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="company_branch_delete0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="company_branch_delete1" name="company_branch_delete" class="custom-control-input @if ($errors->has('company_branch_delete')) is-valid @endif" value="1" @if($roles->company_branch_delete === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="company_branch_delete1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('company_branch_delete'))
                                                  {{ $errors->first('company_branch_delete') }}
                                              @endif</span>
                                      </div>
                                     <div class="form-group">
                                                <label class="col-sm-2 control-label col-lg-2 mb-3">Branches Assigned Question View  </label>
                                                <div class="col-lg-10">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="company_branch_question_view0" name="company_branch_question_view" class="custom-control-input @if ($errors->has('company_branch_question_view')) is-valid @endif" value="0" @if($roles->company_branch_question_view === 0)checked="checked"@endif>
                                                        <label class="custom-control-label" for="company_branch_question_view0">Inactive</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="company_branch_question_view1" name="company_branch_question_view" class="custom-control-input @if ($errors->has('company_branch_question_view')) is-valid @endif" value="1" @if($roles->company_branch_question_view === 1)checked="checked"@endif>
                                                        <label class="custom-control-label" for="company_branch_question_view1"> Active</label>
                                                    </div>
                                                </div>
                                                <span class="help-block">@if ($errors->has('company_branch_question_view'))
                                                        {{ $errors->first('company_branch_question_view') }}
                                                    @endif</span>
                                      </div>
                                      <div class="form-group">
                                                <label class="col-sm-2 control-label col-lg-2 mb-3"> Assign Question To Branches  </label>
                                                <div class="col-lg-10">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="company_branch_question_assign0" name="company_branch_question_assign" class="custom-control-input @if ($errors->has('company_branch_question_assign')) is-valid @endif" value="0" @if($roles->company_branch_question_assign === 0)checked="checked"@endif>
                                                        <label class="custom-control-label" for="company_branch_question_assign0">Inactive</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="company_branch_question_assign1" name="company_branch_question_assign" class="custom-control-input @if ($errors->has('company_branch_question_assign')) is-valid @endif" value="1" @if($roles->company_branch_question_assign === 1)checked="checked"@endif>
                                                        <label class="custom-control-label" for="company_branch_question_assign1"> Active</label>
                                                    </div>
                                                </div>
                                                <span class="help-block">@if ($errors->has('company_branch_question_assign'))
                                                        {{ $errors->first('company_branch_question_assign') }}
                                                    @endif</span>
                                      </div>
                                      <div class="form-group">
                                                <label class="col-sm-2 control-label col-lg-2 mb-3"> Unassign Question To Branches  </label>
                                                <div class="col-lg-10">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="company_branch_question_delete0" name="company_branch_question_delete" class="custom-control-input @if ($errors->has('company_branch_question_delete')) is-valid @endif" value="0" @if($roles->company_branch_question_delete === 0)checked="checked"@endif>
                                                        <label class="custom-control-label" for="company_branch_question_delete0">Inactive</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="company_branch_question_delete1" name="company_branch_question_delete" class="custom-control-input @if ($errors->has('company_branch_question_delete')) is-valid @endif" value="1" @if($roles->company_branch_question_delete === 1)checked="checked"@endif>
                                                        <label class="custom-control-label" for="company_branch_question_delete1"> Active</label>
                                                    </div>
                                                </div>
                                                <span class="help-block">@if ($errors->has('company_branch_question_delete'))
                                                        {{ $errors->first('company_branch_question_delete') }}
                                                    @endif</span>
                                      </div>
                                  </div>
                                </section> 
                                <section class="card">
                                  <header class="card-header">
                                      Companies Users
                                  </header>
                                  <div class="card-body">
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2 mb-3">Companies Users View  </label>
                                        <div class="col-lg-10">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="company_user_view0" name="company_user_view" class="custom-control-input @if ($errors->has('company_user_view')) is-valid @endif" value="0" @if($roles->company_user_view === 0)checked="checked"@endif>
                                                <label class="custom-control-label" for="company_user_view0">Inactive</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="company_user_view1" name="company_user_view" class="custom-control-input @if ($errors->has('company_user_view')) is-valid @endif" value="1" @if($roles->company_user_view === 1)checked="checked"@endif>
                                                <label class="custom-control-label" for="company_user_view1"> Active</label>
                                            </div>
                                        </div>
                                        <span class="help-block">@if ($errors->has('company_user_view'))
                                                {{ $errors->first('company_user_view') }}
                                            @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Companies Users Create  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="company_user_create0" name="company_user_create" class="custom-control-input @if ($errors->has('company_user_create')) is-valid @endif" value="0" @if($roles->company_user_create === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="company_user_create0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="company_user_create1" name="company_user_create" class="custom-control-input @if ($errors->has('company_user_create')) is-valid @endif" value="1" @if($roles->company_user_create === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="company_user_create1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('company_user_create'))
                                                  {{ $errors->first('company_user_create') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Companies Users Update  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="company_user_update0" name="company_user_update" class="custom-control-input @if ($errors->has('company_user_update')) is-valid @endif" value="0" @if($roles->company_user_update === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="company_user_update0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="company_user_update1" name="company_user_update" class="custom-control-input @if ($errors->has('company_user_update')) is-valid @endif" value="1" @if($roles->company_user_update === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="company_user_update1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('company_user_update'))
                                                  {{ $errors->first('company_user_update') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Companies Users Delete  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="company_user_delete0" name="company_user_delete" class="custom-control-input @if ($errors->has('company_user_delete')) is-valid @endif" value="0" @if($roles->company_user_delete === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="company_user_delete0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="company_user_delete1" name="company_user_delete" class="custom-control-input @if ($errors->has('company_user_delete')) is-valid @endif" value="1" @if($roles->company_user_delete === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="company_user_delete1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('company_user_delete'))
                                                  {{ $errors->first('company_user_delete') }}
                                              @endif</span>
                                      </div>
                              
                                  </div>
                                </section> 
                                 <section class="card">
                                  <header class="card-header">
                                      Questions
                                  </header>
                                  <div class="card-body">
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2 mb-3">Questions View  </label>
                                        <div class="col-lg-10">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="question_view0" name="question_view" class="custom-control-input @if ($errors->has('question_view')) is-valid @endif" value="0" @if($roles->question_view === 0)checked="checked"@endif>
                                                <label class="custom-control-label" for="question_view0">Inactive</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="question_view1" name="question_view" class="custom-control-input @if ($errors->has('question_view')) is-valid @endif" value="1" @if($roles->question_view === 1)checked="checked"@endif>
                                                <label class="custom-control-label" for="question_view1"> Active</label>
                                            </div>
                                        </div>
                                        <span class="help-block">@if ($errors->has('question_view'))
                                                {{ $errors->first('question_view') }}
                                            @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Questions Create  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="question_create0" name="question_create" class="custom-control-input @if ($errors->has('question_create')) is-valid @endif" value="0" @if($roles->question_create === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="question_create0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="question_create1" name="question_create" class="custom-control-input @if ($errors->has('question_create')) is-valid @endif" value="1" @if($roles->question_create === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="question_create1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('question_create'))
                                                  {{ $errors->first('question_create') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Questions Update  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="question_update0" name="question_update" class="custom-control-input @if ($errors->has('question_update')) is-valid @endif" value="0" @if($roles->question_update === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="question_update0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="question_update1" name="question_update" class="custom-control-input @if ($errors->has('question_update')) is-valid @endif" value="1" @if($roles->question_update === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="question_update1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('question_update'))
                                                  {{ $errors->first('question_update') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Questions Delete  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="question_delete0" name="question_delete" class="custom-control-input @if ($errors->has('question_delete')) is-valid @endif" value="0" @if($roles->question_delete === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="question_delete0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="question_delete1" name="question_delete" class="custom-control-input @if ($errors->has('question_delete')) is-valid @endif" value="1" @if($roles->question_delete === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="question_delete1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('question_delete'))
                                                  {{ $errors->first('question_delete') }}
                                              @endif</span>
                                      </div>
                              
                                  </div>
                                </section>
                                <section class="card">
                                  <header class="card-header">
                                      Questions Options
                                  </header>
                                  <div class="card-body">
                                      <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2 mb-3">Questions Options View  </label>
                                        <div class="col-lg-10">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="question_options_view0" name="question_options_view" class="custom-control-input @if ($errors->has('question_options_view')) is-valid @endif" value="0" @if($roles->question_options_view === 0)checked="checked"@endif>
                                                <label class="custom-control-label" for="question_options_view0">Inactive</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="question_options_view1" name="question_options_view" class="custom-control-input @if ($errors->has('question_options_view')) is-valid @endif" value="1" @if($roles->question_options_view === 1)checked="checked"@endif>
                                                <label class="custom-control-label" for="question_options_view1"> Active</label>
                                            </div>
                                        </div>
                                        <span class="help-block">@if ($errors->has('question_options_view'))
                                                {{ $errors->first('question_options_view') }}
                                            @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Questions Options Create  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="question_options_create0" name="question_options_create" class="custom-control-input @if ($errors->has('question_options_create')) is-valid @endif" value="0" @if($roles->question_options_create === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="question_options_create0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="question_options_create1" name="question_options_create" class="custom-control-input @if ($errors->has('question_options_create')) is-valid @endif" value="1" @if($roles->question_options_create === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="question_options_create1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('question_options_create'))
                                                  {{ $errors->first('question_options_create') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Questions Options Update  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="question_options_update0" name="question_options_update" class="custom-control-input @if ($errors->has('question_options_update')) is-valid @endif" value="0" @if($roles->question_options_update === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="question_options_update0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="question_options_update1" name="question_options_update" class="custom-control-input @if ($errors->has('question_options_update')) is-valid @endif" value="1" @if($roles->question_options_update === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="question_options_update1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('question_options_update'))
                                                  {{ $errors->first('question_options_update') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Questions Options Delete  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="question_options_delete0" name="question_options_delete" class="custom-control-input @if ($errors->has('question_options_delete')) is-valid @endif" value="0" @if($roles->question_options_delete === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="question_options_delete0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="question_options_delete1" name="question_options_delete" class="custom-control-input @if ($errors->has('question_options_delete')) is-valid @endif" value="1" @if($roles->question_options_delete === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="question_options_delete1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('question_options_delete'))
                                                  {{ $errors->first('question_options_delete') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Customer Review View  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="customer_review_view0" name="customer_review_view" class="custom-control-input @if ($errors->has('customer_review_view')) is-valid @endif" value="0" @if($roles->customer_review_view === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="customer_review_view0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="customer_review_view1" name="customer_review_view" class="custom-control-input @if ($errors->has('customer_review_view')) is-valid @endif" value="1" @if($roles->customer_review_view === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="customer_review_view1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('customer_review_view'))
                                                  {{ $errors->first('customer_review_view') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Customer Review Mail  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="customer_review_mail0" name="customer_review_mail" class="custom-control-input @if ($errors->has('customer_review_mail')) is-valid @endif" value="0" @if($roles->customer_review_mail === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="customer_review_mail0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="customer_review_mail1" name="customer_review_mail" class="custom-control-input @if ($errors->has('customer_review_mail')) is-valid @endif" value="1" @if($roles->customer_review_mail === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="customer_review_mail1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('customer_review_mail'))
                                                  {{ $errors->first('customer_review_mail') }}
                                              @endif</span>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 control-label col-lg-2 mb-3">Customer Review Delete  </label>
                                          <div class="col-lg-10">
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="customer_review_delete0" name="customer_review_delete" class="custom-control-input @if ($errors->has('customer_review_delete')) is-valid @endif" value="0" @if($roles->customer_review_delete === 0)checked="checked"@endif>
                                                  <label class="custom-control-label" for="customer_review_delete0">Inactive</label>
                                              </div>
                                              <div class="custom-control custom-radio custom-control-inline">
                                                  <input type="radio" id="customer_review_delete1" name="customer_review_delete" class="custom-control-input @if ($errors->has('customer_review_delete')) is-valid @endif" value="1" @if($roles->customer_review_delete === 1)checked="checked"@endif>
                                                  <label class="custom-control-label" for="customer_review_delete1"> Active</label>
                                              </div>
                                          </div>
                                          <span class="help-block">@if ($errors->has('customer_review_delete'))
                                                  {{ $errors->first('customer_review_delete') }}
                                              @endif</span>
                                      </div>
                              
                                  </div>
                                </section>    
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