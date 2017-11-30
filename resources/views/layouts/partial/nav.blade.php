<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar nav -->
        <ul class="nav">
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
            <li class="nav-header">AcePlus Logs</li>
            <li nav-id='report'  class="has-sub" >
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-calendar"></i>
                    <span>Logs</span>
                </a>

                <ul class="sub-menu">
                    <li nav-id="report-sale-summary"><a href="/log/backend">Backend Server Log</a></li>
                    <li nav-id="report-sale-summary"><a href="/log/frontend">Frontend Client Log</a></li>
                    <li nav-id="report-sale-summary"><a href="/log/activation">Activation Log</a></li>
                    <li nav-id="report-sale-summary"><a href="/log/loginuserlog">Login User Log</a></li>
                </ul>
            </li>


            <li class="nav-header">AcePlus Backend</li>

            <li  nav-id='modifier'  class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-users"></i>
                    <span>Site Setup</span>
                </a>
                <ul class="sub-menu">
                    <li nav-id="modifier-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Role</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="modifier-manage-modifier"><a href="/role/create">Entry</a></li>
                            <li nav-id="modifier-manage-modifierpanel"><a href="/role">List</a></li>
                        </ul>
                    </li>
                    <li nav-id="modifier-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Permission</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="modifier-manage-modifier"><a href="/permission/create">Entry</a></li>
                            <li nav-id="modifier-manage-modifierpanel"><a href="/permission">List</a></li>

                        </ul>
                    </li>
                    <li nav-id="modifier-create" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Staff</span>
                        </a>

                        <ul class="sub-menu">
                            <li nav-id="modifier-create-modifier"><a href="/user/create">Entry</a></li>
                            <li nav-id="modifier-create-modifierpanel"><a href="/user">List</a></li>
                        </ul>
                    </li>
                    <li nav-id="">
                        <a href="/config">
                            <b class="caret pull-right"></b>
                            <span>Site Config</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li  nav-id='modifier'  class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-users"></i>
                    <span>Tablet Activation Setup</span>
                </a>
                <ul class="sub-menu">
                    <li nav-id="modifier-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Backend Server</span>
                        </a>
                        <ul class="sub-menu">
                            <li nav-id="modifier-manage-modifier"><a href="/backend/create">Entry</a></li>
                            <li nav-id="modifier-manage-modifierpanel"><a href="/backend">List</a></li>
                        </ul>
                    </li>

                    <li nav-id="modifier-manage" class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <span>Frontend</span>
                        </a>
                        <ul class="sub-menu">
                            <li nav-id="modifier-manage-modifierpanel"><a href="/frontend">List</a></li>
                        </ul>
                    </li>
                   
                </ul>
            </li>

            <li  nav-id='modifier'  class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-users"></i>
                    <span>Frontend Client</span>
                </a>
                <ul class="sub-menu">
                    <li nav-id="modifier-manage-modifierpanel"><a href="/frontend_client">List</a></li>
                </ul>
            </li>    

             <li  nav-id='modifier'  class="has-sub">
                <a href="/systemreference">
                    <i class="fa fa-users"></i>
                    <span>System Reference</span>
                </a>
            </li>          

        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>    <!-- end #sidebar -->