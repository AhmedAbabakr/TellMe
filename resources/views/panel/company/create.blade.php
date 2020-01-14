@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{route('company.index')}}">Companies</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add Company</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('company.store')}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Company English Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('company_name_en')) is-valid @endif"  name="company_name_en" value="{{old('company_name_en')}}" >
                                          <span class="help-block">@if ($errors->has('company_name_en'))
                                                  {{ $errors->first('company_name_en') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                   <div class="form-group">
                                      <label class="col-sm-2 control-label">Company Arabic Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('company_name_ar')) is-valid @endif"  name="company_name_ar" value="{{old('company_name_ar')}}" >
                                          <span class="help-block">@if ($errors->has('company_name_ar'))
                                                  {{ $errors->first('company_name_ar') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Company Admin Username </label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('company_username')) is-valid @endif"  name="company_username" value="{{old('company_username')}}">
                                          <span class="help-block">@if ($errors->has('company_username'))
                                                  {{ $errors->first('company_username') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Company Admin Email (Optional)</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control @if ($errors->has('company_email')) is-valid @endif"  name="company_email" value="{{old('company_email')}}">
                                          <span class="help-block">@if ($errors->has('company_email'))
                                                  {{ $errors->first('company_email') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Company Admin Password </label>
                                      <div class="col-sm-10">
                                          <input type="password" class="required form-control @if ($errors->has('company_password')) is-valid @endif"  name="company_password" >
                                          <span class="help-block">@if ($errors->has('company_password'))
                                                  {{ $errors->first('company_password') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Company Admin Confirm Password </label>
                                      <div class="col-sm-10">
                                          <input type="password" class="required form-control @if ($errors->has('company_password')) is-valid @endif"  name="company_password_confirmation" > 
                                      </div>
                                  </div>
                                   <div class="form-group">
                                        <label class="col-lg-2 control-label"  for="company_logo">Company Logo </label>
                                        <div class="col-lg-10">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                    <div>
                                                     <span class="btn btn-white btn-file">
                                                     <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                     <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                     <input type="file" name="company_logo" class="default" value="{{old('company_logo')}}" />
                                                     </span>
                                                        
                                                        
                                                    </div>
                                                     <div class="form-text text-muted">
                                                           @if ($errors->has('company_logo'))
                                                              {{ $errors->first('company_logo') }}
                                                          @endif
                                                         </div>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="col-sm-2 control-label ">App Background Color </label>
                                      <div class="col-sm-10">
                                          <div id="cp5b" class="input-group colorpicker-component colorpicker-element" title="Using format option" data-colorpicker-id="7">
                                              <input type="text" class="required form-control input-lg" name="company_color" value="{{old('company_color')}}">
                                              <div class="input-group-append">
                                                  <span class="input-group-addon btn btn-outline-secondary"><i style="background-color: rgb(49, 195, 178);"></i></span>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                        <label class="col-lg-2 control-label"  for="company_background">Company Background (Optional)</label>
                                        <div class="col-lg-10">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                    <div>
                                                     <span class="btn btn-white btn-file">
                                                     <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                     <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                     <input type="file" name="company_background" class="default" value="{{old('company_background')}}" />
                                                     </span>
                                                        
                                                        
                                                    </div>
                                                     <div class="form-text text-muted">
                                                           @if ($errors->has('company_background'))
                                                              {{ $errors->first('company_background') }}
                                                          @endif
                                                         </div>
                                                </div>
                                        </div>
                                    </div>
                                   <div class="form-group">
                                        <label class="col-sm-2 control-label col-sm-2">Company Address English (Optional)</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control ckeditor" name="company_address_en" rows="6">{{old('company_address_en')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-sm-2">Company Address Arabic (Optional)</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control ckeditor" name="company_address_ar" rows="6">{{old('company_address_ar')}}</textarea>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                      <label class="col-sm-2 control-label">Mobile Number (Optional)</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="number form-control @if ($errors->has('company_phone')) is-valid @endif"  name="company_phone" value="{{old('company_phone')}}">
                                          <span class="help-block">@if ($errors->has('company_phone'))
                                                  {{ $errors->first('company_phone') }}
                                              @endif</span>
                                      </div>
                                  </div>
                              
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('company.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                            
                         </div>
                      </section>
                </div>
              </div>
@endsection