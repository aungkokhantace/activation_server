@extends('layouts.master')
@section('title','Backend Server Activation Detail')
@section('content')

<!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Backend Server Activation Detail</h1>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label for="site_url" class="detail">WebSite URL</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
           <label for="site_url" class="detail">{{ $backend->website_url }} </label>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label for="status" class="detail">Status</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label for="status" class="detail">{{ $backend->status }}</label>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label for="description" class="detail">Description</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label for="description" class="detail">{{ $backend->description }}</label>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label for="backend_activationkey" class="detail">Backend Activation Key</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label for="backend_activationkey" class="detail">{{ $backend->backend_activationkey }}</label>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label for="max_count" class="detail">Client Count<span class="require">*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <label for="client_count" class="detail">{{$backend->client_count}}</label>
        </div>
    </div>

    {!! Form::open(array('url' => 'backend/detail/update', 'class'=> 'form-horizontal user-form-border','id'=>'frm_backend')) !!}

        <input type="hidden" name="id" value="{{$backend->id}}"/>
        <br/>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <select class="form-control" name="new_client">
                    @for ( $x = 1; $x <= 100; $x++)
                        <option vale="{{$x}}">{{$x}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <input type="button" value="Adding New Client" class="form-control btn-primary" onclick="add_client_confirm_setup('backend')">
            </div>
            
        </div>
    {!! Form::close() !!}

</div>
@stop

@section('page_script')
@stop