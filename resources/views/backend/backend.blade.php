@extends('layouts.master')
@section('title','Backend Server Activation')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">{{isset($backend) ?  'Backend Server Edit' : 'Backend Server Entry' }}</h1>

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

    @if($action == 'edit')
    <br/><br/>
    <h3 class="page-header">Frontends List</h3>


    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">

                    <thead>
                    <tr>
                        <th>Frontend Activation Key</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="search-col" con-id="activation_key">Frontend Activation Key</th>
                        <th class="search-col" con-id="description">Description</th>
                        <th class="search-col" con-id="status">Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($frontends as $frontend)
                        <tr>
                            <td>{{$frontend->activation_key}}</td>
                            <td>{{$frontend->description}}</td>
                            <td>{{$frontend->status}}</td>
                            <td><a class="btn btn-primary" href="/frontend/edit/{{$frontend->id}}">Edit</a></td>
                            <td>
                                <form id="frm_frontend_status_{{$frontend->id}}" method="post" action="/frontend/updatestatus">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="frontend_id" name="frontend_id"  value="{{$frontend->id}}">
                                    <input type="hidden" id="status" name="status"  value="{{$frontend->status}}">
                                    <input type="hidden" id="backend_id" name="backend_id"  value="{{$frontend->backend_id}}">
                                    <button type="button" onclick="frontend_update('{{$frontend->id}}','{{$frontend->status}}','{{$frontend->backend_id}}');" class="btn btn-primary">
                                        @if($frontend->status == 'active')
                                            INACTIVE
                                        @else
                                            ACTIVE
                                        @endif
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@stop

@section('page_script')
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function() {

            $('#list-table tfoot th.search-col').each( function () {
                var title = $('#list-table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            var table = $('#list-table').DataTable({
                aLengthMenu: [
                    [5,25, 50, 100, 200, -1],
                    [5,25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 5,
                "order": [[ 2, "desc" ]],
                stateSave: false,
                "pagingType": "full",
                "dom": '<"pull-right m-t-20"i>rt<"bottom"lp><"clear">',

            });


            // Apply the search
            table.columns().eq( 0 ).each( function ( colIdx ) {
                $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                    table
                            .column( colIdx )
                            .search( this.value )
                            .draw();
                } );

            });
        });

        function frontend_update(id,status,backend_id) {

            swal({
                        title: "Are you sure?",
                        text: "You want to change status ? ",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55 ",
                        confirmButtonText: "Confirm",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $("#frontend_id").val(id);
                            $("#status").val(status);
                            $("#backend_id").val(backend_id);
                            $("#frm_frontend_status_" + id).submit();

                        } else {
                            return;
                        }
                    });

        }
    </script>
@stop