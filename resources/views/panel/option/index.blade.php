@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                               <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{route('question.index')}}">Questions Bank</a></li>
                              <li class="breadcrumb-item active" aria-current="page" style="text-transform: capitalize;">{{$question->question_content_en}} Options</li>
                            
                          </ol>
                      </nav>
                      <!--breadcrumbs end -->
                  </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                 @if(Session::has('success'))
                  <div class="alert alert-success" role="alert">
                    {{Session('success')}}
                  </div>
                  @endif
              <section class="card">
              <header class="card-header" style="text-transform: capitalize;">
                  {{$question->question_content_en}} Options
	           
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Option English Text</th>
                  <th>Option Arabic Text</th>
                  <th>Question </th>
                  <th>Question Type </th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($options as $option)
              <tr>

                <td>{{$option->option_text_en}}</td>
                <td>{{$option->option_text_ar}}</td>
                
                <td>{{$option->question->question_content_en}}</td>
                <td>
                  @if($option->option_type === 0)
                    Single Choice Option
                  @elseif($option->option_type === 1)
                    Multiple Choice Option
                  @elseif($option->option_type === 2)
                    Text Option
                  @endif
                </td>
                
                 <td>
                  @can('roleupdate', auth()->user()->type->roles->question_options_update)
                    <a class="btn btn-primary btn-xs" title="Edit" href="{{route('options.edit',['question_id'=>encrypt($question->question_id), 'id'=>encrypt($option->option_id)])}}"><i class="fa fa-pencil"></i></a>
                  @endcan
                </td>   
                                 
              @endforeach
              </tfoot>
              </table>
              </div>
              </div>
              </section>
              </div></div>
             
@endsection