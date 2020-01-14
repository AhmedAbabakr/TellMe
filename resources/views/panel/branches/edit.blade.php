@extends('layouts.app')
@section('content')

             <div class="row">
                   <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{route('branch.index')}}">Company Branches</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Edit Branch</li>
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
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('branch.update',encrypt($branch->branch_id))}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('PUT')
                                  @if(auth()->user()->company === null)
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Company </label>
                                      <div class="col-sm-10">
                                          <select class="required number form-control @if ($errors->has('company_id')) is-valid @endif" name="company_id" >
                                             <option  value="" disabled="disabled" selected="">Select Company</option>
                                                        @foreach($companies as $company)

                                                        <option value="{{$company->company_id}}" 
                                                        
                                                        @if($branch->company_id == $company->company_id)

                                                           {{"selected"}}
                                                        @endif >{{$company->company_name_en}}</option>
                                                       @endforeach
                                          </select>
                                          <span class="help-block">@if ($errors->has('company_id'))
                                                  {{ $errors->first('company_id') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  @endif
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Branch Name</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('branch_name')) is-valid @endif" id="namee" name="branch_name" value="{{$branch->branch_name}}" >
                                          <span class="help-block">@if ($errors->has('branch_name'))
                                                  {{ $errors->first('branch_name') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Branch Code </label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('branch_code')) is-valid @endif"  name="branch_code" value="{{$branch->branch_code}}">
                                          <span class="help-block">@if ($errors->has('branch_code'))
                                                  {{ $errors->first('branch_code') }}
                                              @endif</span>
                                      </div>
                                  </div>
                              
                                  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('branch.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                            
                         </div>
                      </section>
                </div>
              </div>
@endsection