@for($i=0;$i < 3 ;$i++)
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