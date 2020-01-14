@extends('layouts.app')
@section('content')
              <!-- page start-->
              <section class="card">
                  <header class="card-header">
                      Review Details
                      <span class="pull-right">
                          
                          <a href="{{route('customers.index')}}" class="btn btn-warning" type="button"><i class="fa fa-reply"></i> Back</a>
                      </span>
                  </header>

              </section>
              <div class="row">
                  <div class="col-md-12">
                      <section class="card">
                          <div class="bio-graph-heading project-heading">
                              <strong> Review Details </strong>
                          </div>
                          <div class="card-body bio-graph-info">
                              <!--<h1>New Dashboard BS3 </h1>-->
                              <div class="row p-details">
                                  <div class="bio-row">
                                      <p><span >Branch </span>: {{$review->branch->branch_name}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span >Company </span>: {{$review->company->company_name_en}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span >Customer </span>: {{$review->customer_name}}</p>
                                  </div>
                                  @if($review->customer_phone !== null)
                                  <div class="bio-row">
                                      <p><span >Phone</span>: {{$review->customer_phone}}</p>
                                  </div>
                                  @endif
                                  @if($review->customer_email !== null)
                                  <div class="bio-row">
                                      <p><span >Email </span>: {{$review->customer_email}} </p>
                                  </div>
                                  @endif
                                  @if($review->customer_contact_method !== null)
                                  <div class="bio-row">
                                      <p><span >Contact Method </span>: {{$review->customer_contact_method}}</p>
                                  </div>
                                  @endif
                                  <div class="bio-row">
                                      <p><span >Created Time </span>: {{$review->created_at->format('d M Y H:m')}}</p>
                                  </div>
                                  @if($review->customer_note !== null)
                                  <div class="col-lg-12">
                                      <div class="mtop20">
                                        
                                          <div >Customer Note:</div>
                                          <p>{{$review->customer_note}}</p>
                                      </div>
                                      
                                  </div>
                                  @endif
                              </div>

                          </div>

                      </section>

                      <section class="card">
                        <header class="card-header">
                          Questions And Answers
                        </header>
                        <div class="card-body">
                            @foreach($review->answers as $answer)
                           <div class="classic-search">
                              <h4>{{$answer->question->question_content_en}}</h4>
                              
                              @if($answer->question->question_type === 0)
                                <p>- {{$answer->options->option_text_en}} </p>
                              @elseif($answer->question->question_type === 1)
                                <p>- {{$answer->options->option_text_en}} </p>
                              @elseif($answer->question->question_type === 2)
                                <p>- {{$answer->option_text}} </p>
                              @elseif($answer->question->question_type === 3)
                                <p>- {{$answer->options->option_text_en}} </p>
                              @elseif($answer->question->question_type === 4)
                                @if((int)$answer->option_text)
                                  <p>-  
                                    @for($i=1;$i<= (int)$answer->option_text;$i++)
                                        <i class="fa fa-star"></i>
                                       @endfor
                                        @for($i=1;$i <= 5 - (int)$answer->option_text;$i++)
                                              <i class="fa fa-star-o"  ></i>
                                              @endfor
                                 </p>
                                 @else
                                  <p>- Answer Not Valid </p>
                                @endif
                              @elseif($answer->question->question_type === 5)
                                @if($answer->option_text == 1)
                                  <p>- Sad</p>
                                @elseif($answer->option_text == 2)
                                  <p>- Somewhat sad</p>
                                @elseif($answer->option_text == 3)
                                  <p>- Neutral</p>
                                @elseif($answer->option_text == 4)
                                  <p>- Somewhat happy</p>
                                @elseif($answer->option_text == 5)
                                  <p>- Happy</p>
                                @endif
                              @endif
                          </div>
                          @endforeach 
                        </div>
                      </section>

                  </div>
                
              </div>

@endsection