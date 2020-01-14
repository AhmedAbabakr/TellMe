@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('question.index')}}">Questions Bank</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Edit Question</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('question.update',encrypt($question->question_id))}}" enctype="multipart/form-data" id="commentForm">
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
                                                        
                                                        @if($question->company_id == $company->company_id)

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
                                      <label class="col-sm-2 control-label">Question English Content</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('question_content_en')) is-valid @endif"  name="question_content_en" value="{{$question->question_content_en}}" >
                                          <span class="help-block">@if ($errors->has('question_content_en'))
                                                  {{ $errors->first('question_content_en') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Question Arabic Content</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('question_content_ar')) is-valid @endif"  name="question_content_ar" value="{{$question->question_content_ar}}" >
                                          <span class="help-block">@if ($errors->has('question_content_ar'))
                                                  {{ $errors->first('question_content_ar') }}
                                              @endif</span>
                                      </div>
                                  </div>
                               
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('question.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
@endsection