@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
      {{Session('success')}}
    </div>
    @endif
        <section class="card">
            <header class="card-header">
                Account Setting
                 
            </header>
            <div class="card-body">
                <form method="post" action="{{route('settings.update')}}">
                @csrf()
                @method('PUT')
                     <div class="form-group">
                                      <label class="col-sm-2 control-label">Admin Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('admin_name')) is-valid @endif" id="namee" name="admin_name" value="{{auth()->user()->admin_name}}" >
                                          <span class="help-block">@if ($errors->has('admin_name'))
                                                  {{ $errors->first('admin_name') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Username </label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('admin_username')) is-valid @endif"  name="admin_username" value="{{auth()->user()->admin_username}}">
                                          <span class="help-block">@if ($errors->has('admin_username'))
                                                  {{ $errors->first('admin_username') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                   <div class="form-group">
                                      <label class="col-sm-2 control-label">Email (Optional)</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control @if ($errors->has('admin_email')) is-valid @endif"  name="admin_email" value="{{auth()->user()->admin_email}}">
                                          <span class="help-block">@if ($errors->has('admin_email'))
                                                  {{ $errors->first('admin_email') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  
                                   <div class="form-group">
                                      <label class="col-sm-2 control-label">Password </label>
                                      <div class="col-sm-10">
                                          <input type="password" class="required form-control @if ($errors->has('admin_password')) is-valid @endif"  name="admin_password" >
                                          <span class="help-block">@if ($errors->has('admin_password'))
                                                  {{ $errors->first('admin_password') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Confirm Password </label>
                                      <div class="col-sm-10">
                                          <input type="password" class="required form-control @if ($errors->has('admin_password')) is-valid @endif"  name="admin_password_confirmation" > 
                                      </div>
                                  </div>
                 <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-4">
                          <button class="btn btn-danger" type="submit">Save</button>
                          <a href="{{route('dashboard')}}" class="btn btn-default" type="button">Cancel</a>
                      </div>
                  </div>
                </form>

            </div>
        </section>
    </div>
</div>
@endsection