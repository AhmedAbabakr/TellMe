@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{route('question.index')}}">Questions Bank</a></li>
                              <li class="breadcrumb-item "  style="text-transform: capitalize;"><a href="{{route('options.index',$question->question_id)}}">{{$question->question_content_en}} Options</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Edit Option</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('options.update',['question_id'=>encrypt($question->question_id), 'id'=>encrypt($option->option_id)])}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('PUT')
                                    
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Option English Text</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('option_text_en')) is-valid @endif"  name="option_text_en" value="{{$option->option_text_en}}" >
                                          <span class="help-block">@if ($errors->has('option_text_en'))
                                                  {{ $errors->first('option_text_en') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Option Arabic Text</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="required form-control @if ($errors->has('option_text_ar')) is-valid @endif"  name="option_text_ar" value="{{$option->option_text_ar}}" >
                                          <span class="help-block">@if ($errors->has('option_text_ar'))
                                                  {{ $errors->first('option_text_ar') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  @if($option->option_type === 3)
                                    <div class="form-group">
                                          <label class="col-lg-2 control-label"  for="option_image">Option Image  </label>
                                          <div class="col-lg-10">
                                              <div class="fileupload fileupload-new" data-provides="fileupload">
                                                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                           @if($option->option_image === null)
                                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                            @else
                                                                <img src="{{asset($option->option_image)}}" alt="" />
                                                            @endif
                                                      </div>
                                                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                      <div>
                                                       <span class="btn btn-white btn-file">
                                                       <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select File</span>
                                                       <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                       <input type="file" name="option_image" class="default"  value="{{old('option_image')}}" />
                                                       </span>
                                                          
                                                          
                                                      </div>
                                                       <div class="form-text text-muted">
                                                             @if ($errors->has('option_image'))
                                                                {{ $errors->first('option_image') }}
                                                            @endif
                                                           </div>
                                                  </div>
                                          </div>
                                    </div>
                                  @endif  
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('options.index',encrypt($question->question_id))}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                        
                           
                         </div>
                      </section>
                </div>
              </div>
@endsection