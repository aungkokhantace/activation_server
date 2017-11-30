@extends('layouts.master')
@section('title','System Reference For Developer')
@section('content')

        <!-- begin #content -->
<div id="content" class="content">
    <h1 class="page-header">System Reference List</h1>

    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#backend_server_status"><b>Backend Server Status</b></a></li>
            <li><a data-toggle="tab" href="#frontend_status"><b>Frontend Status</b></a></li>
        </ul>

        <div class="tab-content">
            <div id="backend_server_status" class="tab-pane fade in active">
                <h3>Backend Server Status Reference Description</h3>
                <table border="2" width="300px" style="text-align: center">
                    <tr>
                        <td><strong>Name</strong></td>
                        <td><strong>Value</strong></td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>InActive</td>
                        <td>0</td>
                    </tr>

                </table>
            </div>

            <div id="frontend_status" class="tab-pane fade">
                <h3>Frontend Status Reference Description</h3>
                <table border="2" width="300px" style="text-align: center">
                    <tr>
                        <td><strong>Name</strong></td>
                        <td><strong>Value</strong></td>
                    </tr>
                    <tr>
                        <td>Active</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>InActive</td>
                        <td>0</td>
                    </tr>

                </table>
            </div>
            
    </div>

</div>
@stop

@section('page_script')

@stop