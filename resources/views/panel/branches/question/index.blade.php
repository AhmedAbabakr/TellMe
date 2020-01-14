@extends('layouts.app')
@section('content')
 <!-- page start-->
  <div class="row">
                  <div class="col-lg-12">
                      <!--breadcrumbs start -->
                      <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{route('branch.index')}}">Company Branches</a></li>
                             <li class="breadcrumb-item"><span>{{$branch->branch_name}}</span></li>
                              <li class="breadcrumb-item active" aria-current="page">{{$branch->branch_name}} Questions</li>
                            
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
              <header class="card-header">
                  Questions
               @can('rolecreate', auth()->user()->type->roles->company_branch_question_assign)
	              <span class="tools pull-right">
	               <a class="btn btn-primary"  href="{{route('branch.assign.create',encrypt($branch->branch_id))}}" style="margin-right:1%;color: white ">
                                <i class="fa fa-plus"></i> &nbsp;Assign New Question
                              </a>
	             </span>
               @endcan
              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  
                  <th>Question English Content</th>
                  <th>Question Arabic Content</th>
                  <th>Question Type</th>
                  <th>Company</th>
                  <th>Made By</th>
                  <th>Action</th>
                  
              </tr>
              </thead>
              <tbody>
         	    @foreach($questions as $question)
              <tr>

                <td>{{$question->question_content_en}}</td>
                <td>{{$question->question_content_ar}}</td>
                <td>
                  @if($question->question_type === 0)
                    Single Choice Questions
                  @elseif($question->question_type === 1)
                    Multiple Choice Questions
                  @elseif($question->question_type === 2)
                    Text Question
                  @elseif($question->question_type === 3)
                    Image Question
                  @elseif($question->question_type === 4)
                    Star Question
                  @elseif($question->question_type === 5)
                    Smile Face Question
                  @endif
                </td>
                <td>{{$question->company->company_name_en}}</td>
                <td>{{$question->question_made_by}}</td> 
                
                 <td>
                      @can('roledelete', auth()->user()->type->roles->company_branch_question_delete)
                      <a title="Delete" data-toggle="modal" href="#deModal{{$question->question_id}}" class="btn btn-danger btn-xs" ><i class="fa fa-trash-o "></i></a>
                      @endcan
                </td>   
                     @can('roledelete', auth()->user()->type->roles->company_branch_question_delete)
                <div class="modal fade" id="deModal{{$question->question_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title">Delete Confirmation</h4>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this record.
                           <!-- <input type="hidden" id="catidh" value=""/>-->
                          </div>
                          <div class="modal-footer">
                              <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                              <form method="POST"  action="{{route('branch.assign.delete',['branch_id'=>encrypt($branch->branch_id),'question_id'=>encrypt($question->question_id)])}}">
                                @csrf
                                @method('Delete')
                                <button type="submit" class="btn btn-danger">Confirm</button>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>                   
                      @endcan
              @endforeach
              </tfoot>
              </table>
              </div>
              </div>
              </section>
              </div></div>
             
@endsection