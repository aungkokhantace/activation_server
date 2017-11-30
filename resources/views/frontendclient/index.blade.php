@extends('layouts.master')
@section('title','Frontend Client')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Frontend Clients Activation List</h1>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">

                    <thead>
                    <tr>
                        <th>Backend Server</th>
                        <th>Tablet Activation Key</th>
                        <th>Tablet ID</th>
                        <th>Description</th>
                        <th>Start Date</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="search-col" con-id="tablet_activation_key">Backend Server</th>
                        <th class="search-col" con-id="access_total_count">Tablet Activation Key</th>
                        <th class="search-col" con-id="status">Tablet ID</th>
                        <th class="search-col" con-id="description">Description</th>
                        <th class="search-col" con-id="created_by">Start Date</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($frontendClients as $frontendClient)
                        <tr>
                            <td>{{$frontendClient->backend->website_url}}</td>
                            <td>{{$frontendClient->tablet_activation_key}}</td>
                            <td>{{$frontendClient->tablet_id}}</td>
                            <td>{{$frontendClient->description}}</td>
                            <td>{{$frontendClient->start_date}}</td>
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