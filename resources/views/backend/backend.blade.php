@extends('layouts.master')
@section('title','Backend Server Activation')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($backend) ?  'Backend Server Activation Edit' : 'Backend Server Activation Entry' }}</h1>

    @if(isset($backend))
        {!! Form::open(array('url' => 'backend/update', 'class'=> 'form-horizontal user-form-border')) !!}

    @else
        {!! Form::open(array('url' => 'backend/store', 'class'=> 'form-horizontal user-form-border')) !!}
    @endif
    <input type="hidden" name="id" value="{{isset($backend)? $backend->id:''}}"/>
    <br/>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="site_url">WebSite URL<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" required class="form-control" id="website_url" name="website_url" placeholder="Enter Site URL" value="{{ isset($backend)? $backend->website_url:Request::old('website_url') }}"/>
            <p class="text-danger">{{$errors->first('website_url')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="max_count">Client Count<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            @if(isset($backend))
                <input type="text" required class="form-control" id="client_count" name="client_count" value="{{$backend->client_count}}" readonly/>
            @else
                <input type="text" required class="form-control" id="client_count" name="client_count" placeholder="Enter Maximum Client Count For Tablet Activation" />
            @endif 
            <p class="text-danger">{{$errors->first('client_count')}}</p>
        </div>
    </div>

    @if(isset($backend))
        <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="max_count">Backend Activation Key<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <input type="text" class="form-control" id="key" name="activation_key"  value="{{$backend->backend_activationkey}}" readonly/>
            
        </div>
    </div>

    @endif

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="description">Description<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-2">
            <input type="text" required class="form-control" id="description" name="description" placeholder="Enter Description" value="{{ isset($backend)? $backend->description:Request::old('description') }}"/>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <label for="status">Status<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-2">
            <select name="status" class="form-control">
                @if(isset($backend))
                    @if($backend->status == "active")
                        <option value="active" selected>active</option>
                        <option value="inactive">inactive</option>
                    @else
                        <option value="inactive" selected>inactive</option>
                        <option value="active">active</option>
                    @endif
                @else
                    <option value="active">active</option>
                    <option value="inactive">inactive</option>
                @endif
            </select>
            <p class="text-danger">{{$errors->first('description')}}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="submit" name="submit" value="{{isset($backend)? 'UPDATE' : 'ADD'}}" class="form-control btn-primary">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
            <input type="button" value="CANCEL" class="form-control cancel_btn" onclick="cancel_setup('backend')">
        </div>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('page_script')
@stop