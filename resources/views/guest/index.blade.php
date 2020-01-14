<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Tell Me">
    <meta name="keyword" content="Tell Me, rating">
    <link rel="shortcut icon" href="{{asset('img/faviconx.png')}}">

    <title>Tell Me </title>

    <!-- Bootstrap core CSS -->
   <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet" />
</head>
<body class="full-width">
  <section id="container" >
     <section>
                  <div class="card card-primary">
                      <!--<div class="card-heading navyblue"> INVOICE</div>-->
                      <div class="card-body">
                          <div class="row invoice-list">
                              <div class="col-md-12 text-center corporate-id">
                                  <img src="{{asset('img/Logo.png')}}" alt="">
                              </div>
                              <div class="col-md-12 text-center">
                                  <h4>Review Information</h4>
                                  <p>
                                      {{$review->customer_name}} <br>
                                      {{$review->customer_email}} <br>
                                      {{$review->branch->branch_name}} <br>
                                      {{$review->company->company_name_en}}<br>
                                  </p>
                              </div>
                             
                          </div>

                          <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-10 mx-auto text-center form p-4">
                      <section class="card">
                         <div class="card-body">
                      
                              <form  class="justify-content-center" method="POST" action="{{route('review.guest.store',encrypt($review->review_id))}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')
                                 {{--@foreach($questions as $question)--}}
                                 @for($i = 0 ; $i < count($questions); $i++)
                                 @if($questions[$i]->question->question_type === 0 ||$questions[$i]->question->question_type === 3 )
                                  <div class="form-group row">
                                      <label class="col-sm-4 control-label">{{$questions[$i]->question->question_content_en}} </label>
                                      <input type="hidden" name="question_id[{{$i}}][]" value="{{$questions[$i]->question_id}}">
                                      <input type="hidden" name="question_type[{{$i}}][]" value="{{$questions[$i]->question->question_type}}">
                                      <div class="col-sm-8">
                                          <select class="required number form-control @if ($errors->has('option_id')) is-valid @endif " name="option_id[{{$i}}][]" >
                                             <option  value="" disabled="disabled" selected="">Select Option</option>
                                                       @foreach($questions[$i]->question->options as $option) 
                                                         <option value="{{$option->option_id}}" 
                                                        
                                                        @if(old('option_id') == $option->option_id)

                                                           {{"selected"}}
                                                        @endif >{{$option->option_text_en}}</option>
                                                       @endforeach
                                          </select>
                                          <span class="help-block">@if ($errors->has('option_id'))
                                                  {{ $errors->first('option_id') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  @elseif($questions[$i]->question->question_type === 4)
                                      <input type="hidden" name="question_id[{{$i}}][]" value="{{$questions[$i]->question_id}}">
                                      <input type="hidden" name="question_type[{{$i}}][]" value="{{$questions[$i]->question->question_type}}">
                                  <div class="form-group row">
                                      <label class="col-sm-4 control-label">{{$questions[$i]->question->question_content_en}} </label>
                                      <div class="col-sm-8">
                                          <select class="required number form-control @if ($errors->has('option_text')) is-valid @endif " name="option_text[{{$i}}]" >
                                             <option  value="" disabled="disabled" selected="">Select Option</option>
                                                       
                                                         <option value="1" @if(old('option_text') == 1){{"selected"}}@endif >1 Star</option>
                                                         <option value="2" @if(old('option_text') == 2){{"selected"}}@endif >2 Star</option>
                                                         <option value="3" @if(old('option_text') == 3){{"selected"}}@endif >3 Star</option>
                                                         <option value="4" @if(old('option_text') == 4){{"selected"}}@endif >4 Star</option>
                                                         <option value="5" @if(old('option_text') == 4){{"selected"}}@endif >5 Star</option>
                                                      
                                          </select>
                                          <span class="help-block">@if ($errors->has('option_text'))
                                                  {{ $errors->first('option_text') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  @elseif($questions[$i]->question->question_type === 5)
                                      <input type="hidden" name="question_id[{{$i}}][]" value="{{$questions[$i]->question_id}}">
                                      <input type="hidden" name="question_type[{{$i}}][]" value="{{$questions[$i]->question->question_type}}">
                                   <div class="form-group row">
                                      <label class="col-sm-4 control-label">{{$questions[$i]->question->question_content_en}} </label>
                                      <div class="col-sm-8">
                                          <select class="required number form-control @if ($errors->has('option_text')) is-valid @endif " name="option_text[{{$i}}]" >
                                             <option  value="" disabled="disabled" selected="">Select Option</option>
                                                       
                                                         <option value="1" @if(old('option_text') == 1){{"selected"}}@endif >Sad</option>
                                                         <option value="2" @if(old('option_text') == 2){{"selected"}}@endif >Somewhat sad</option>
                                                         <option value="3" @if(old('option_text') == 3){{"selected"}}@endif >Neutral</option>
                                                         <option value="4" @if(old('option_text') == 4){{"selected"}}@endif >Somewhat happy</option>
                                                         <option value="5" @if(old('option_text') == 4){{"selected"}}@endif >Happy</option>
                                                      
                                          </select>
                                          <span class="help-block">@if ($errors->has('option_text'))
                                                  {{ $errors->first('option_text') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  @elseif($questions[$i]->question->question_type === 2)
                                   <div class="form-group row">
                                      <input type="hidden" name="question_id[{{$i}}][]" value="{{$questions[$i]->question_id}}">
                                      <input type="hidden" name="question_type[{{$i}}][]" value="{{$questions[$i]->question->question_type}}">
                                      <label class="col-sm-4 control-label">{{$questions[$i]->question->question_content_en}} </label>
                                      <div class="col-sm-8">
                                         <textarea rows="4" class="form-control" name="option_text[{{$i}}]"></textarea>
                                          <span class="help-block">@if ($errors->has('admin_type'))
                                                  {{ $errors->first('admin_type') }}
                                              @endif</span>
                                      </div>
                                  </div>
                                  @elseif($questions[$i]->question->question_type === 1)
                                   <div class="form-group row">
                                      <input type="hidden" name="question_id[{{$i}}][]" value="{{$questions[$i]->question_id}}">
                                      <input type="hidden" name="question_type[{{$i}}][]" value="{{$questions[$i]->question->question_type}}">
                                      <label class="col-sm-4 control-label">{{$questions[$i]->question->question_content_en}} </label>
                                      @foreach($questions[$i]->question->options as $option) 
                                      <div class="col-sm-12  custom-control custom-checkbox  mb-3">
                                              <input type="checkbox" class="custom-control-input" id="customCheck{{$option->option_id}}" name="option_id[{{$i}}][]" value="{{$option->option_id}}">
                                              <label class="custom-control-label " for="customCheck{{$option->option_id}}" style="position: absolute;">{{$option->option_text_en}}</label>
                                          <span class="help-block">@if ($errors->has('admin_type'))
                                                  {{ $errors->first('admin_type') }}
                                              @endif</span>
                                              <br>
                                      </div>
                                      @endforeach
                                  </div>
                                  @endif
                                 @endfor
                                 {{--@endforeach--}}
                                  <div class="form-group">
                                      
                                          <button class="btn btn-danger" type="submit">Save</button>
                                          <a href="{{route('admins_user.index')}}" class="btn btn-default" type="button">Cancel</a>
                                      
                                  </div>
                              </form>
                        
                            
                         </div>
                      </section>
                </div>
              </div>
                      </div>
                  </div>
              </section>

      </section>

    <!-- js placed at the end of the document so the pages load faster -->
 <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
     <script type="text/javascript" src="{!!asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/common-scripts.js')}}"></script>
    <script type="text/javascript" charset="utf-8">
       $(document).ready(function() {
              $("#commentForm").validate();
          } );
    </script>

  </body>
  <footer class="site-footer" >
          <div class="text-center">
              {{date('Y')}} &copy;<a href="hashcode.me" style="color: #fff">Hash Code</a>.
              
          </div>
      </footer>
</html>
