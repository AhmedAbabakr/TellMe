@extends('layouts.app')
@section('content')


                         <div class="row">
                         <div class="col-sm-12">
                 @if(Session::has('success'))
                  <div class="alert alert-success" role="alert">
                    {{Session('success')}}
                  </div>
                  @endif
                  </div>
                <div class="col-lg-12">
                      <section class="card">

                         <div class="card-body">
                      
                              <form class="form-horizontal tasi-form" method="POST" action="{{route('app.setting.update')}}" enctype="multipart/form-data" id="commentForm">
                                 @csrf()
                                 @method('PUT')
                                 @foreach($settings as $setting)
                                  
                                  @if($setting->setting_key === "MAIL_USERNAME" )

                                      <div class="form-group">
                                        <label class="col-sm-2 control-label">{{__("message.$setting->setting_key")}}</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="required email form-control @if ($errors->has($setting->setting_key)) is-valid @endif"  name="{{$setting->setting_key}}" value="{{$setting->setting_value}}" >
                                            <span class="help-block">@if ($errors->has($setting->setting_key))
                                                    {{ $errors->first($setting->setting_key) }}
                                                @endif</span>
                                        </div>
                                    </div>
                                      @elseif($setting->setting_key === "MAIL_PASSWORD")
                                         <div class="form-group">
                                        <label class="col-sm-2 control-label">{{__("message.$setting->setting_key")}}</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="required  form-control @if ($errors->has($setting->setting_key)) is-valid @endif"  name="{{$setting->setting_key}}" value="{{$setting->setting_value}}" >
                                            <span class="help-block">@if ($errors->has($setting->setting_key))
                                                    {{ $errors->first($setting->setting_key) }}
                                                @endif</span>
                                        </div>
                                    </div>
                                    @else
                                     <div class="form-group">
                                        <label class="col-sm-2 control-label">{{__("message.$setting->setting_key")}}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="required  form-control @if ($errors->has($setting->setting_key)) is-valid @endif"  name="{{$setting->setting_key}}" value="{{$setting->setting_value}}" >
                                            <span class="help-block">@if ($errors->has($setting->setting_key))
                                                    {{ $errors->first($setting->setting_key) }}
                                                @endif</span>
                                        </div>
                                    </div>
                                      @endif
                                 
                                  @endforeach
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