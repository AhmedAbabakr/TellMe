@extends('layouts.app')
@section('content')

     <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{route('branch.index')}}">Company Branches</a></li>
                             <li class="breadcrumb-item"><span>{{$branch->branch_name}}</span></li>
                              <li class="breadcrumb-item " ><a href="{{route('branch.assign.index',encrypt($branch->branch_id))}}">{{$branch->branch_name}} Questions</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Assign Question</li>
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                      <section class="card">
                         <div class="card-body">
                      @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('branch.assign.post',encrypt($branch->branch_id))}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('POST')
                               
                                    <div class="form-group">
                                      <label class="col-sm-2 control-label col-lg-2 mb-3" >Questions </label>
                                       @if($questions->count() > 0)
                                      <div class="col-lg-10">
                                         @foreach($questions as $question)
                                             <div class="custom-control custom-checkbox mb-3">
                                              <input type="checkbox" class="custom-control-input" id="customCheck{{$question->question_id}}" name="questions[]" value="{{$question->question_id}}">
                                              <label class="custom-control-label" for="customCheck{{$question->question_id}}">{{$question->question_content_en}}</label>
                                          </div>
                                         @endforeach
                                      </div>
                                      @else
                                      <div class="col-lg-10">
                                        <p>No questions available to assign </p>
                                      </div>
                                      @endif
                                  </div>
                                
                                  
                                    
                                 
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-4">
                                        @if($questions->count() > 0)
                                          <button class="btn btn-danger" type="submit">Save</button>
                                        @endif
                                          <a href="{{route('branch.assign.index',encrypt($branch->branch_id))}}" class="btn btn-default" type="button">Cancel</a>
                                      </div>
                                  </div>
                              </form>
                       
                           
                         </div>
                      </section>
                </div>
              </div>
              <script type="text/javascript">
@if( isset($html) )
 $("#1").append({{$html}})
@endif
</script>
@endsection