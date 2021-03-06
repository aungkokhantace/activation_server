@extends('layouts.master')
@section('title','Backend Server Activation')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Backend Server Activation Listing</h1>

    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <div class="buttons pull-right">
                <button type="button" onclick='create_setup("backend");' class="btn btn-default btn-md first_btn">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
                <button type="button" onclick='edit_setup("backend");' class="btn btn-default btn-md second_btn">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </button>
               <!--  <button type="button" onclick="delete_setup('backend');" class="btn btn-default btn-md third_btn">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button> -->
            </div>
        </div>

    </div>

    {!! Form::open(array('id'=> 'frm_customer' ,'url' => 'backend_server_activation/destroy', 'class'=> 'form-horizontal user-form-border')) !!}
    {{ csrf_field() }}
    <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">

                    <thead>
                    <tr>
                        <th><input type='checkbox' name='check' id='check_all'/></th>
                        <th>WebSite URL</th>
                        <th>Description</th>
                        <th>Client Count</th>
                        <th>Activation Key</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th class="search-col" con-id="siteUrl">WebSite URL</th>
                        <th class="search-col" con-id="description">Description</th>
                        <th class="search-col" con-id="client_count">Client Count</th>
                        <th class="search-col" col-id="activation_key">Activation Key</th>
                        <th class="search-col" con-id="status">Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($backends as $backend)
                        <tr>
                            <td><input type="checkbox" class="check_source" name="edit_check" value="{{ $backend->id }}" id="all"></td>
                            <td><a href="/backend/edit/{{$backend->id}}">{{$backend->website_url}}</td>
                            <td>{{$backend->description}}</td>
                            <td>{{$backend->client_count}}</td>
                            <td>{{$backend->backend_activationkey}}</td>
                            <td>{{$backend->status}}</td>
                            <td><a href="/backend/detail/{{$backend->id}}">Detail</a></td>
                            <td><a href="/backend/edit/{{$backend->id}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
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
//            new $.fn.dataTable.FixedHeader( table, {
//            });


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
    </script>
@stop