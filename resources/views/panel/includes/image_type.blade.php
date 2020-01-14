 @for($i=0;$i < 4;$i++)
 
 <div class="form-group">
        <label class="col-lg-2 control-label"  for="option_image">Option Image  </label>
        <div class="col-lg-10">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+file" alt="" />
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                    <div>
                     <span class="btn btn-white btn-file">
                     <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select File</span>
                     <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                     <input type="file" name="option_image[]" class="default" value="{{old('option_image')}}" />
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
       <div class="form-group">
          <label class="col-sm-2 control-label">Option English Text</label>
          <div class="col-sm-10">
              <input type="text" class="required form-control @if ($errors->has('option_text_en')) is-valid @endif"  name="option_text_en[]" value="{{old('option_text_en')}}" >
              <span class="help-block">@if ($errors->has('option_text_en'))
                      {{ $errors->first('option_text_en') }}
                  @endif</span>
          </div>
      </div>
       <div class="form-group">
          <label class="col-sm-2 control-label">Option Arabic Text</label>
          <div class="col-sm-10">
              <input type="text" class="required form-control @if ($errors->has('option_text_ar')) is-valid @endif"  name="option_text_ar[]" value="{{old('option_text_ar')}}" >
              <span class="help-block">@if ($errors->has('option_text_ar'))
                      {{ $errors->first('option_text_ar') }}
                  @endif</span>
          </div>
      </div>
      @endfor
      
