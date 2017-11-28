@extends('layouts.master')
@section('title','Login User Log')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">

    <h1 class="page-header">Login User Logs</h1>

    {!! Form::open(array('id'=> 'frm_backend_server_log' ,'url' => 'log/backend', 'class'=> 'form-horizontal user-form-border')) !!}
    {{ csrf_field() }}
    <input type="hidden" id="selected_checkboxes" name="selected_checkboxes" value="">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="listing">
                <input type="hidden" id="pageSearchedValue" name="pageSearchedValue" value="">
                <table class="table table-striped list-table" id="list-table">

                    <thead>
                    <tr>
                        <th>IP Address</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th class="search-col" con-id="website_url">IP Address</th>
                        <th class="search-col" con-id="backend_activationkey">Time</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($loginuserlogs as $loginuserlog)
                        <tr>
                            <td>{{$loginuserlog->ip_address}}</td>
                            <td>{{$loginuserlog->time}}</td>
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