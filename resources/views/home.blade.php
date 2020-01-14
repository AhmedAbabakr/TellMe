@extends('layouts.app')

@section('content')
<div class="row state-overview">
                @if(auth()->user()->company !== null)
                  <div class="col-lg-3 col-sm-6">
                      <section class="card">
                          <div class="symbol terques">
                              <i class="fa fa-building-o"></i>
                          </div>
                          <div class="value">
                              <h1 >{{$companies}}</h1>
                              <p>Total Companies</p>
                          </div>
                      </section>
                  </div>
                @endif
                  <div class="col-lg-3 col-sm-6">
                      <section class="card">
                          <div class="symbol red">
                              <i class="fa fa-bookmark"></i>
                          </div>
                          <div class="value">
                              <h1 >{{$branches}}</h1>
                              <p>Total Branches</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="card">
                          <div class="symbol yellow">
                              <i class="fa fa-question-circle"></i>
                          </div>
                          <div class="value">
                              <h1 >{{$questions}}</h1>
                              <p>Total Questions</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="card">
                          <div class="symbol blue">
                              <i class="fa fa-comments"></i>
                          </div>
                          <div class="value">
                              <h1 >{{$reviews}}</h1>
                              <p>Total Reviews</p>
                          </div>
                      </section>
                  </div>
              </div>
@endsection
