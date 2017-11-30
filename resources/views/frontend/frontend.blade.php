@extends('layouts.master')
@section('title','frontend Server Activation')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($frontend) ?  'frontend Client Edit' : 'frontend Client Entry' }}</h1>

    @if(isset($frontend))
        {!! Form::open(array('url' => 'frontend/update', 'class'=> 'form-horizontal user-form-border','id'=>'frontend_client')) !!}

    @else
        {!! Form::open(array('url' => 'frontend/store', 'class'=> 'form-horizontal user-form-border','id'=>'frontend_client')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($frontend)? $frontend->id:''}}"/>
    <br/>

    @if(isset($frontend))
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="max_count">frontend Activation Key</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input readonly type="text" class="form-control" id="key" name="activation_key"  value="{{$frontend->activation_key}}" readonly/>

            </div>
        </div>
        <br/>

        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="description">Description<span class="require">*</span></label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-2">
                <input type="text" required class="form-control" id="description" name="description" placeholder="Enter Description" value="{{ isset($frontend)? $frontend->description:Request::old('description') }}"/>
                <p class="text-danger">{{$errors->first('description')}}</p>
            </div>
        </div>
    <br />

        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <label for="max_count">frontend Status</label>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <input readonly type="text" class="form-control" id="key" name="status"  value="{{$frontend->status}}" readonly/>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <input type="button" value="{{isset($frontend)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary" onclick="submit_confirm('frontend_client')">
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                <a class="form-control btn-primary" href="/backend/edit/{{$frontend->backend_id}}">CANCEL</a>
            </div>
        </div>
    @endif
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
         $('#frontend_client').validate({
                 submitHandler: function(form) {
                    $('input[type="submit"]').attr('disabled','disabled');
                    form.submit();
            }
        }); 
    });
</script>
@stop